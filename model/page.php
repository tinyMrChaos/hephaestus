<?php
class model_page {
    function get_all(){
        return model::factory('database')->query('select * from page order by timestamp desc');
    }
    function add_page($title, $body, $user, $show_in_menu){
        $sql = 'insert into page (title, content, author, timestamp, show_in_menu) values ("'.$title.'", "'.$body.'", "'.$user.'", "'.time().'", "'.$show_in_menu.'")';
        model::factory('database')->query($sql);
        return model::factory('database')->get_connection()->insert_id;

    }
    function edit_page($title, $body, $idpage, $show_in_menu){
        $params = array(
                    'title' => $title,
                    'body' => $body,
                    'show_in_menu' => $show_in_menu,
                    'idpage' => $idpage,
                    'time' => time()
                );
        $sql = 'update page set title=:title, content=:body, timestamp=:time, show_in_menu=:show_in_menu where idpage=:idpage';
        model::factory('database')->safe_query($sql, $params);
    }

    function get_data($id){
        $res = model::factory('database')->query('select * from page where idpage ="'.$id.'"');
        if(count($res))
            return $res[0];

        return false;
    }
    function delete($id){
        $sql = 'delete from page where idpage = "'.$id.'"';
        model::factory('database')->query($sql);
    }
}