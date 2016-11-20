<div class="pagination-center">
    <?php if ($page_count_global > 1) : ?>
        <ul class="pagination pagination-sm ">

            <?php if (isset($previous_global)) : ?>
                <li class="page-item ">
                    <a rel="prev" href="<?php echo get_current_url_without_query_string(). '?' . http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => $previous_global))?>">&laquo;&nbsp;<?php echo "précédent"?></a>
                </li>
            <?php else : ?>
                <li class="disabled page-item">
                    <span>&laquo;&nbsp;<?php echo "précédent"?></span>
                </li>
            <?php endif; ?>

            <?php if ($start_page_global > 1): ?>
                <li class="page-item">
                    <a href="<?php echo get_current_url_without_query_string(). '?'. http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => 1))?>">1</a>
                </li>
                <?php if ($start_page_global == 3) : ?>
                    <li class="page-item">
                        <a href="<?php echo get_current_url_without_query_string(). '?'. http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => 2))?>">2</a>
                    </li>
                <?php elseif ($start_page_global != 2) : ?>
                    <li class="disabled page-item">
                        <span>&hellip;</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php foreach ($pages_in_range_global as $page) : ?>
                <?php if ($page != $current_global) : ?>
                    <li class="hidden-xs page-item">
                        <a href="<?php echo get_current_url_without_query_string(). '?'. http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => $page))?>"><?php echo $page  ?></a>
                    </li>
                <?php else : ?>
                    <li class="hidden-xs active page-item">
                        <span><?php echo $page ?></span>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>

            <?php if ($page_count_global > $end_page_global) : ?>
                <?php if ($page_count_global > ($end_page_global + 1)) : ?>
                    <?php if ($page_count_global > ($end_page_global + 2)) : ?>
                        <li class="hidden-xs disabled page-item">
                            <span>&hellip;</span>
                        </li>
                    <?php else :  ?>
                        <li class="page-item">
                            <a href= "<?php echo get_current_url_without_query_string(). '?' . http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => $page_count -1)) ?>"><?php echo $page_count_global -1 ?></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="hidden-xs page-item">
                    <a href="<?php echo get_current_url_without_query_string(). '?' .http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => $page_count_global))?>"><?php echo $page_count_global ?></a>
                </li>
            <?php endif; ?>

            <?php if (isset($next_global)) : ?>
                <li class="page-item ">
                    <a  rel="next" href="<?php echo get_current_url_without_query_string(). '?'. http_build_query(array('id_project' => $_GET['id_project'], $pagination_item => $next_global))?>"><?php echo "suivant"?> &nbsp;&raquo;</a>
                </li>
            <?php else: ?>
                <li class="disabled page-item">
                    <span><?php echo "suivant"?>&nbsp;&raquo;</span>
                </li>
            <?php endif; ?>
        </ul>

    <?php endif; ?>
</div>
