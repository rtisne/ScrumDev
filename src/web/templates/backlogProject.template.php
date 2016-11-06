<?php
include("createUserStory.template.php");
?>
<h2>Backlog<button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createUSmodal"><a href="#">Creer une UserStory</a></button></h2>
<div class="panel panel-default">
    <table class="table table-bordered">
        <thead class="thead-backlog">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Coût</th>
                <th class="text-center">Priorité</th>
                <th class="text-center">Etat</th>
                <th class="text-center">Commit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td>En temps qu'utilisateur, je souhaite pouvoir m'inscrire (table Utilisateur) sur le site afin de pouvoir gérer mes projets scrum.</td>
                <td class="text-center">3</td>
                <td class="text-center">1</td>
                <td class="text-center">En Cours</td>
                <td class="text-center"></td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td>En temps que membre du projet, je souhaite pouvoir ajouter un indice de difficulté à une US afin de gérer le temps pour chaque US</td>
                <td class="text-center">1</td>
                <td class="text-center">1</td>
                <td class="text-center">Finie</td>
                <td class="text-center">#53be453</td>
            </tr>
        </tbody>
    </table>
</div>
