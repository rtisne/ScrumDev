/*// ########## Initialisation after a page has been loaded


 function initialize(config, statics) {

    function update_statics(update_config) {
        statics.boardID = update_config.boardID;
        statics.projectPHID = update_config.projectPHID;
        statics.order = update_config.order;
        statics.moveURI = update_config.moveURI;
        statics.createURI = update_config.createURI;
    }

    function setup() {

        $.on(
            'quicksand-redraw',
            null,
            function (e) {
                var data = e.getData();
                if (!data.newResponse.boardConfig) {
                    return;
                }
                var new_config;
                if (data.fromServer) {
                    new_config = data.newResponse.boardConfig;
                    statics.boardConfigCache[data.newResponseID] = new_config;
                } else {
                    new_config = statics.boardConfigCache[data.newResponseID];
                    statics.boardID = new_config.boardID;
                }
                update_statics(new_config);
            });

        return true;
    }

    if (!statics.setup) {
        update_statics(config);
        var current_page_id = JX.Quicksand.getCurrentPageID();
        statics.boardConfigCache = {};
        statics.boardConfigCache[current_page_id] = config;
        statics.setup = setup();
    }

    if (!statics.workboard) {
        statics.workboard = new WorkboardController()
            .setUploadURI(config.uploadURI)
            .setCoverURI(config.coverURI)
            .setMoveURI(config.moveURI)
            .setCreateURI(config.createURI)
            .setChunkThreshold(config.chunkThreshold)
            .start();
    }

    var board_kpid = config.projectPHID;
    var board_node = $.(config.boardID);

    var board = statics.workboard.newBoard(board_kpid, board_node)
        .setOrder(config.order)
        .setPointsEnabled(config.pointsEnabled);



    var column_maps = config.columnMaps;
    for (var column_kpid in column_maps) {
        var column = board.getColumn(column_kpid);
        var column_map = column_maps[column_kpid];
        for (var index = 0; index < column_map.length; index++) {
            column.newCard(column_map[index]);
        }
    }

    var order_maps = config.orderMaps;
    for (var object_kpid in order_maps) {
        board.setOrderMap(object_kpid, order_maps[object_kpid]);
    }

    var property_maps = config.propertyMaps;
    for (var property_kpid in property_maps) {
        board.setObjectProperties(property_kpid, property_maps[property_kpid]);
    }

    board.start();

}

//####################### kanban manager



(function($){

    $.fn.kanban =  function($options) {

        if(jQuery.type($options) == undefined){
            $(this)._boards = {};
        }

        $.extend($.fn.kanban.defaults,$options);
    };



    $.fn.kanban.defaults = {
        _boards: null,
        _panOrigin: null,
        _panNode: null,
        _panX: null,

        start: function () {
            this._setupCoverImageHandlers();
            this._setupPanHandlers();
            this._setupEditHandlers();

            return this;
        }
    };


        $.fn.kanaban.newBoard  = function(kpid, node) {
            var board = new WorkboardBoard(this, kpid, node);
            $(this)._boards[kpid] = board;
            return board;
        };

        _getBoard = function(board_kpid) {
            return this._boards[board_kpid];
        };



        _getBoardFromNode = function(node) {
            var board_node = JX.DOM.findAbove(node, 'div', 'jx-workboard');
            var board_kpid = JX.Stratcom.getData(board_node).boardPHID;
            return this._getBoard(board_kpid);
        },

        _setupPanHandlers = function() {
            var mousedown = $.proxy(this, this._onpanmousedown);
            var mousemove = $.proxy(this, this._onpanmousemove);
            var mouseup = $.proxy(this, this._onpanmouseup);

            $.on('mousedown', 'workboard-shadow', mousedown);
            $.on('mousemove', null, mousemove);
            $.on('mouseup', null, mouseup);
        },

        _onpanmousedown = function(event) {
            if (!JX.Device.isDesktop()) {
                return;
            }

            if (e.getNode('workpanel')) {
                return;
            }

            if (JX.Stratcom.pass()) {
                return;
            }

            e.kill();
            // Get mouse dimension and position
            this._pan_origin = "";
            this._panNode = e.getNode('workboard-shadow');
            this._panX = this._panNode.scrollLeft;
        },

        _onpanmousemove =  function(event) {
            if (!this._panOrigin) {
                return;
            }

            var cursor = ""; // dimension de la souris
            this._panNode.scrollLeft = this._panX + (this._panOrigin.x - cursor.x);
        },

        _onpanmouseup = function() {
            this._panOrigin = null;
        },

        _setupEditHandlers = function() {
            var onadd = $.proxy(this, this._onaddcard);
            var onedit = $.proxy(this, this._oneditcard);

            JX.Stratcom.listen('click', 'column-add-task', onadd);
            JX.Stratcom.listen('click', 'edit-project-card', onedit);
        },

        _onaddcard = function(e) {
            // We want the 'boards-dropdown-menu' behavior to see this event and
            // close the dropdown, but don't want to follow the link.
            e.prevent();

            var column_data = e.getNodeData('column-add-task');
            var column_kpid = column_data.columnPHID;

            var board_kpid = column_data.boardPHID;
            var board = this._getBoard(board_kpid);
            var column = board.getColumn(column_kpid);

            var request_data = {
                responseType: 'card',
                columnPHID: column.getPHID(),
                projects: column_data.projectPHID,
                visiblePHIDs: column.getCardPHIDs(),
                order: board.getOrder()
            };

            new JX.Workflow(this.getCreateURI(), request_data)
                .setHandler(JX.bind(board, board.updateCard))
                .start();
        },

        _oneditcard =  function(e) {
            e.kill();

            var column_node = e.getNode('project-column');
            var column_kpid = JX.Stratcom.getData(column_node).columnPHID;

            var board = this._getBoardFromNode(column_node);
            var column = board.getColumn(column_kpid);

            var request_data = {
                responseType: 'card',
                columnPHID: column.getPHID(),
                visiblePHIDs: column.getCardPHIDs(),
                order: board.getOrder()
            };

            new JX.Workflow(e.getNode('tag:a').href, request_data)
                .setHandler(JX.bind(board, board.updateCard))
                .start();
        };




})(jQuery);

//#################### WorkBoardDesk

function getData(){
    if (!node || !node.getAttribute) {
        return;
    }
    var meta_id = (node.getAttribute('data-id') || '').split('_');

    if (meta_id[0] && meta_id[1]) {
        var block = $(this)._data[meta_id[0]];
        var index = meta_id[1];
        if (block && (index in block)) {
            return block[index];
        }
    }

    var data = {};
    if (!$(this)._data[1]) { // data block 1 is reserved for JavaScript
        $(this)._data[1] = {};
    }
    $(this)._data[1][$(this)._dataIndex] = data;
    node.setAttribute('data-id', '1_' + ($(this)._dataIndex++));
    return data;
}

(function($){






_findCardsInColumn =  function(column_node) {
    return JX.DOM.scry(column_node, 'li', 'project-card');
},

_onmovecard = function(list, item, after_node, src_list) {
    list.lock();
    $.(item).addClass('drag-sending');

    var src_kanban_id = getData(src_list.getRootNode()).columnPHID;
    var dst_kanban_id = getData(list.getRootNode()).columnPHID;

    var item_kanban_id = getData(item).objectPHID;
    var data = {
        objectPHID: item_kanban_id,
        columnPHID: dst_kanban_id,
        order: $(this).getOrder()
    };

    if (after_node) {
        data.afterPHID = getData(after_node).objectPHID;
    }

    var before_node = item.nextSibling;
    if (before_node) {
        var before_kanban_id = getData(before_node).objectPHID;
        if (before_kanban_id) {
            data.beforePHID = before_kanban_id;
        }
    }

    var visible_kanban_ids = [];
    var column = $(this).getColumn(dst_kanban_id);
    for (var object_kanban_id in column.getCards()) {
        visible_kanban_ids.push(object_kanban_id);
    }

    data.visiblePHIDs = visible_kanban_ids.join(',');

    var onupdate = $.proxy(
        $(this),
        $(this)._oncardupdate,
        list,
        src_kanban_id,
        dst_kanban_id,
        data.afterPHID);

};

_oncardupdate = function(list, src_kpid, dst_kpid, after_kpid, response) {
    var src_column = $(this).getColumn(src_kpid);
    var dst_column = $(this).getColumn(dst_kpid);

    var card = src_column.removeCard(response.objectPHID);
    dst_column.addCard(card, after_kpid);

    src_column.markForRedraw();
    dst_column.markForRedraw();

    $($(this)).updateCard(response);

    list.unlock();
};

updateCard =  function(response, options) {
    options = options || {};
    options.dirtyColumns = options.dirtyColumns || {};

    var columns = $(this).getColumns();

    var kanban_id = response.objectPHID;

    if (!$(this)._templates[kanban_id]) {
        for (var add_kanban_id in response.columnMaps) {
            $(this).getColumn(add_kanban_id).newCard(kanban_id);
        }
    }

    $(this).setCardTemplate(kanban_id, response.cardHTML);

    var order_maps = response.orderMaps;
    for (var order_kanban_id in order_maps) {
        $(this).setOrderMap(order_kanban_id, order_maps[order_kanban_id]);
    }

    var column_maps = response.columnMaps;
    var natural_column;
    for (var natural_kanban_id in column_maps) {
        natural_column = $(this).getColumn(natural_kanban_id);
        if (!natural_column) {
            // Our view of the board may be out of date, so we might get back
            // information about columns that aren't visible. Just ignore the
            // position information for any columns we aren't displaying on the
            // client.
            continue;
        }

        natural_column.setNaturalOrder(column_maps[natural_kanban_id]);
    }

    var property_maps = response.propertyMaps;
    for (var property_kanban_id in property_maps) {
        $(this).setObjectProperties(property_kanban_id, property_maps[property_kanban_id]);
    }

    for (var column_kanban_id in columns) {
        var column = columns[column_kanban_id];

        var cards = column.getCards();
        for (var object_kanban_id in cards) {
            if (object_kanban_id !== kanban_id) {
                continue;
            }

            var card = cards[object_kanban_id];
            card.redraw();

            column.markForRedraw();
        }
    }

    $(this)._redrawColumns();
};


_redrawColumns =  function() {
    var columns = $(this).getColumns();
    for (var k in columns) {
        if (columns[k].isMarkedForRedraw()) {
            columns[k].redraw();
        }
    }
};

})(jQuery);


//########## WorkBoardColumn




    construct = function(board, kanban_id, root) {
        $(this)._board = board;
        $(this)._kanban_id = kanban_id;
        $(this)._root = root;

        $(this)._panel = JX.DOM.findAbove(root, 'div', 'workpanel');
        $(this)._pointsNode = JX.DOM.find($(this)._panel, 'span', 'column-points');

        $(this)._pointsContentNode = JX.DOM.find(
            $(this)._panel,
            'span',
            'column-points-content');

        $(this)._cards = {};
        $(this)._naturalOrder = [];
    };

    $.fn.kanban_column_members =  {


        _kanban_id: null,
            _root
    :
        null,
            _board
    :
        null,
            _cards
    :
        null,
            _naturalOrder
    :
        null,
            _panel
    :
        null,
            _pointsNode
    :
        null,
            _pointsContentNode
    :
        null,
            _dirty
    :
        true
    };
        getPHID: function() {
        return $(this)._kanban_id;
    },

    getRoot: function() {
        return $(this)._root;
    },

    getCards: function() {
        return $(this)._cards;
    },

    getCard: function(kanban_id) {
        return $(this)._cards[kanban_id];
    },

    getBoard: function() {
        return $(this)._board;
    },

    setNaturalOrder: function(order) {
        $(this)._naturalOrder = order;
        return $(this);
    },

    getPointsNode: function() {
        return $(this)._pointsNode;
    },

    getPointsContentNode: function() {
        return $(this)._pointsContentNode;
    },

    getWorkpanelNode: function() {
        return $(this)._panel;
    },

    newCard: function(kanban_id) {
        var card = new JX.WorkboardCard($(this), kanban_id);

        $(this)._cards[kanban_id] = card;
        $(this)._naturalOrder.push(kanban_id);

        return card;
    },

    removeCard: function(kanban_id) {
        var card = $(this)._cards[kanban_id];
        delete $(this)._cards[kanban_id];

        for (var ii = 0; ii < $(this)._naturalOrder.length; ii++) {
            if ($(this)._naturalOrder[ii] == kanban_id) {
                $(this)._naturalOrder.splice(ii, 1);
                break;
            }
        }

        return card;
    },

    addCard: function(card, after) {
        var kanban_id = card.getPHID();

        card.setColumn($(this));
        $(this)._cards[kanban_id] = card;

        var index = 0;

        if (after) {
            for (var ii = 0; ii < $(this)._naturalOrder.length; ii++) {
                if ($(this)._naturalOrder[ii] == after) {
                    index = ii + 1;
                    break;
                }
            }
        }

        if (index > $(this)._naturalOrder.length) {
            $(this)._naturalOrder.push(kanban_id);
        } else {
            $(this)._naturalOrder.splice(index, 0, kanban_id);
        }

        return $(this);
    },

    getCardNodes: function() {
        var cards = $(this).getCards();

        var nodes = [];
        for (var k in cards) {
            nodes.push(cards[k].getNode());
        }

        return nodes;
    },

    getCardPHIDs: function() {
        return JX.keys($(this).getCards());
    },

    getPointLimit: function() {
        return getData($(this).getRoot()).pointLimit;
    },

    markForRedraw: function() {
        $(this)._dirty = true;
    },

    isMarkedForRedraw: function() {
        return $(this)._dirty;
    },

    redraw = function() {
        var board = $(this).getBoard();
        var order = board.getOrder();

        var list;
        if (order == 'natural') {
            list = $(this)._getCardsSortedNaturally();
        } else {
            list = $(this)._getCardsSortedByKey(order);
        }

        var content = [];
        for (var ii = 0; ii < list.length; ii++) {
            var card = list[ii];

            var node = card.getNode();
            content.push(node);

        }

        JX.DOM.setContent($(this).getRoot(), content);

        $(this)._redrawFrame();

        $(this)._dirty = false;
    };

    _getCardsSortedNaturally = function() {
        var list = [];

        for (var ii = 0; ii < $(this)._naturalOrder.length; ii++) {
            var kanban_id = $(this)._naturalOrder[ii];
            list.push($(this).getCard(kanban_id));
        }

        return list;
    },

    _getCardsSortedByKey: function(order) {
        var cards = $(this).getCards();

        var list = [];
        for (var k in cards) {
            list.push(cards[k]);
        }

        list.sort($.proxy($(this)), $(this)._sortCards, order));

        return list;
    },

    _sortCards: function(order, u, v) {
        var ud = $(this).getBoard().getOrderVector(u.getPHID(), order);
        var vd = $(this).getBoard().getOrderVector(v.getPHID(), order);

        for (var ii = 0; ii < ud.length; ii++) {
            if (ud[ii] > vd[ii]) {
                return 1;
            }

            if (ud[ii] < vd[ii]) {
                return -1;
            }
        }

        return 0;
    },

    _redrawFrame: function() {
        var cards = $(this).getCards();
        var board = $(this).getBoard();

        var points = {};
        var count = 0;
        var decimal_places = 0;
        for (var kanban_id in cards) {
            var card = cards[kanban_id];

            var card_points;
            if (board.getPointsEnabled()) {
                card_points = card.getPoints();
            } else {
                card_points = 1;
            }

            if (card_points !== null) {
                var status = card.getStatus();
                if (!points[status]) {
                    points[status] = 0;
                }
                points[status] += card_points;

                // Count the number of decimal places in the point value with the
                // most decimal digits. We'll use the same precision when rendering
                // the point sum. This avoids rounding errors and makes the display
                // a little more consistent.
                var parts = card_points.toString().split('.');
                if (parts[1]) {
                    decimal_places = Math.max(decimal_places, parts[1].length);
                }
            }

            count++;
        }

        var total_points = 0;
        for (var k in points) {
            total_points += points[k];
        }
        total_points = total_points.toFixed(decimal_places);

        var limit = $(this).getPointLimit();

        var display_value;
        if (limit !== null && limit !== 0) {
            display_value = total_points + ' / ' + limit;
        } else {
            display_value = total_points;
        }

        if (board.getPointsEnabled()) {
            display_value = count + ' | ' + display_value;
        }

        var over_limit = ((limit !== null) && (total_points > limit));

        var content_node = $(this).getPointsContentNode();
        var points_node = $(this).getPointsNode();

        $.replaceWith(content_node, display_value);

        var is_empty = !$(this).getCardPHIDs().length;
        var panel = JX.DOM.findAbove($(this).getRoot(), 'div', 'workpanel');
        JX.DOM.alterClass(panel, 'project-panel-empty', is_empty);
        JX.DOM.alterClass(panel, 'project-panel-over-limit', over_limit);

        var color_map = {
            'phui-tag-shade-disabled': (total_points === 0),
            'phui-tag-shade-blue': (total_points > 0 && !over_limit),
            'phui-tag-shade-red': (over_limit)
        };

        for (var c in color_map) {
            JX.DOM.alterClass(points_node, c, !!color_map[c]);
        }

        JX.DOM.show(points_node);

// WorkboardCard

(function($){
    construct =  function(column, kanban_id) {
        $(this)._column = column;
        $(this)._kanban_id = kanban_id;
    };

    members = {
        _column: null,
        _kanban_id: null,
        _root: null
    };

})(jQuery);




        getPHID: function() {
            return $(this)._kanban_id;
        },

        getColumn: function() {
            return $(this)._column;
        },

        setColumn: function(column) {
            $(this)._column = column;
        },

        getProperties: function() {
            return $(this).getColumn().getBoard().getObjectProperties($(this).getPHID());
        },

        getPoints: function() {
            return $(this).getProperties().points;
        },

        getStatus: function() {
            return $(this).getProperties().status;
        },

        getNode: function() {
            if (!$(this)._root) {
                var kanban_id = $(this).getPHID();
                var template = $(this).getColumn().getBoard().getCardTemplate(kanban_id);
                $(this)._root = JX.$H(template).getFragment().firstChild;

                getData($(this)._root).objectPHID = $(this).getPHID();
            }
            return $(this)._root;
        },

        redraw: function() {
            var old_node = $(this)._root;
            $(this)._root = null;
            var new_node = $(this).getNode();

            if (old_node && old_node.parentNode) {
                JX.DOM.replace(old_node, new_node);
            }

            return $(this);
        }

    }

}
*/