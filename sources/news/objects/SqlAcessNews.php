<?php
Class SQLAcessNews {
    protected function displayOneArticle($idArticle, $valid, $publish) {
        $select = "SELECT `id`, `id_author`, `title`, `text`, `creat_date`, `update_date`, `publish`, `picture`, `valid` 
        FROM `guyaEvents`.`articles`
        INNER JOIN `guyagraines`.`users` ON `articles`.`id_author` = `users`.`idUser`
        WHERE `id` = :idArticle AND `valid`= :valid AND `publish` = :publish;";
    $param = [['prep'=>':idArticle', 'variable'=>$idArticle],
            ['prep'=>':valid', 'variable'=>$valid],
            ['prep'=>':publish', 'variable'=>$publish],];
          return ActionDB::select($select, $param);
    }
}