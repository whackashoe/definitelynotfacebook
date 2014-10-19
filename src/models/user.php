<?php

class User extends BaseModel {
    protected $table = 'users';

    public function get_messages($user_id) {
        $sql = 'SELECT users.public_key, messages.message, messages.id
                FROM messages
                INNER JOIN users ON (users.id = messages.from)
                WHERE messages.to=:user_id
                ORDER BY messages.id DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);


        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function lookup_id_from_key($key) {
        $s_key = $key;	//rip off armor junk for keys
        preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $s_key);
        
        $pre = explode("\n", $s_key);
        $post = [];
        foreach($pre as $p) {
            if(!preg_match("/-----BEGIN'(.*)'/", $p)
            && !preg_match("/-----END'(.*)'/", $p)
            && !preg_match("/Version:'(.*)'/", $p)) {
                $post[] = $p;
            }
        }
        $s_key = implode("\n", $post);


        $sql = 'SELECT id
                FROM users
                WHERE public_key LIKE :public_key';

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":public_key" => "%$s_key%"
        ]);

        $result = $stmt->fetchAll();

        return count($result) == 0 ? false : $result[0]["id"];
    }


}
