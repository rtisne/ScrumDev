<h2 class="text-center"><?=$page_title?></h2>
<form class="form-horizontal" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Nom du projet" required="required" value="<?=(isset($project_name))?$project_name:""?>">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" name="description" placeholder="Description du projet" required="required"><?=(isset($project_desc))?$project_desc:""?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="dev" class="col-sm-2 control-label">Membres</label>
        <div class="col-sm-10">
            <ul class="list-group list_member">
                <li class="list-group-item">
                    <div class="dropdown dropdown-input">
                        <input type="text" id="add_member_input" class="form-control" placeholder="Nom Prenom" aria-describedby="basic-addon2">


                        <ul class="dropdown-menu" id="dropdown_proposal" aria-labelledby="dLabel">
                        </ul>
                    </div>
                </li>
                <?php
                echo "<li class=\"list-group-item\" data-id=\"".$project_owner["id"]."\">".$project_owner['first_name']." ".$project_owner['name']."</li>";
                if(isset($project_members)){
                    foreach ($project_members as $member) {
                        echo "<li class=\"list-group-item\" data-id=\"".$member["id"]."\">".$member['first_name']." ".$member['name']." <a  class=\"pull-right remove_user\"><span class=\"glyphicon glyphicon-remove\"></span></a></li>";
                        echo "<input type=\"hidden\" name=\"member[]\" value=\"". $member["id"] ."\" />";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Product Owner</label>
        <div class="col-sm-10">
            <select class="form-control select_po" name="product_owner">

                <option value="<?=$project_owner["id"]?>" <?=($project_owner['id'] == $product_owner_id)? 'selected="selected"':'';?>><?=$project_owner["first_name"]?> <?=$project_owner["name"]?></option>
                <?php
                if(isset($project_members)){
                    foreach ($project_members as $member) {
                        ?>
                        <option value="<?=$member["id"]?>" <?=($member['id'] == $product_owner_id)? 'selected="selected"':'';?>><?=$member["first_name"]?> <?=$member["name"]?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger" value="delete" name="submit">Supprimer</button>
            <button type="submit" class="btn btn-primary" value="update" name="submit">Valider</button>
        </div>
    </div>
</form>
</div>
