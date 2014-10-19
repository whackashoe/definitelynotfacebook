<?php

class Controller {
    protected $db;
    
    public function __construct($config) {
        $this->db = $config->getConnection();
    }

    public function read_messages_by_key($key) {
        $user = new User($this->db);
        $errors = [];
        $messages = [];
        $user_id = null;

        $user_id = $user->lookup_id_from_key($key);

        if(!$user_id) {
            $errors[] = "Key not in database, you need to send or receive a message first.";
        }

        if(count($errors) == 0) {
            $messages = $user->grab_messages($user_id);
        }

        return new ReceivedResults($errors, $messages);
    }

    public function read_messages_by_id($id) {
        $user = new User($this->db);
        $errors = [];
        $messages = [];
        $user_id = null;

        if(!$user->exists($id)) {
            $errors[] = "Id not in database, you need to send or receive a message first.";
        } else {
            $user_id = $id;
        }

        if(count($errors) == 0) {
            $messages = $user->get_messages($user_id);
        }

        return new ReceivedResults($errors, $messages);
    }

    public function send_message(array $data) {
        $user = new User($this->db);
        $errors = [];
        $messages = [];
        $send_id = false;
        $receive_id = false;

        if(!isset($data['send_key'])) {
            $errors[] = "send_key not received";
        }

        if(!isset($data['receive_key']) || empty($data['receive_key'])) {
            $errors[] = "receive_key not received";
        }

        if(!isset($data['message']) || empty($data['message'])) {
            $errors[] = "message not received";
        }

        if(count($errors) == 0) {
            if(empty($data['send_key'])) {
                $send_id = 0;
            } else {
                $send_id = $user->lookup_id_from_key($data['send_key']);

                if(!$send_id) {
                    $send_id = $user->insert([
                        'public_key' => $data['send_key']
                    ])->lastInsertId();
                }
            }

            $receive_id = $user->lookup_id_from_key($data['receive_key']);

            if(!$receive_id) {
                $receive_id = $user->insert([
                    'public_key' => $data['receive_key']
                ])->lastInsertId();
            }

            (new Message($this->db))->insert([
                'to'      => $receive_id,
                'from'    => $send_id,
                'message' => $data['message'],
            ]);
        }

        return new SentResults($errors);
    }

    public function view_message(array $data) {
        $errors = [];

        $message = (new Message($this->db))->get($data['id'])->message;
        if(!$message) {
            $errors[] = "Message id not in database.";
        }

        return new ViewResults($errors, $message);
    }

    public function router() {
        switch(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
            case '/':
                header('Content-type: text/html; charset=utf-8');
                echo View::render("layout", [
                    'content' => View::render("index")
                ]);
            break;

            case '/guide':
                header('Content-type: text/html; charset=utf-8');
                echo View::render("layout", [
                    'content' => View::render("guide")
                ]);
            break;

            case '/read':
                header('Content-type: text/html; charset=utf-8');
                echo View::render("layout", [
                    'content' => View::render("read", [
                        'results' => (
                            (strcmp($_SERVER['REQUEST_METHOD'], "GET") == 0)
                                ? $this->read_messages_by_id($_GET['id'])
                                : $this->read_messages_by_key($_POST['your_key'])
                        )
                    ])
                ]);
            break;

            case '/read.json':
                header('Content-type: application/json; charset=utf-8');
                echo json_encode(
                    $this->read_messages([
                        'your_key' => $_POST['your_key'],
                        'id'       => $_GET['id'],
                    ])
                );
            break;

            case '/send':
                header('Content-type: text/html; charset=utf-8');
                echo View::render("layout", [
                    'content' => View::render("send", [
                        'results' => $this->send_message([
                            'send_key'    => $_POST['send_key'],
                            'receive_key' => $_POST['receive_key'],
                            'message'     => $_POST['message'],
                        ]),
                        'receive_id' => $this->db->lastInsertId()
                    ])
                ]);
            break;

            case '/view':
                header('Content-type: text/html; charset=utf-8');
                echo View::render("layout", [
                    'content' => View::render("view", [
                        'results' => $this->view_message([
                            'id' => $_GET['id'],
                        ])
                    ])
                ]);
            break;

            default:
                header('Content-type: text/html; charset=utf-8');
                echo View::render("layout", [
                    'content' => "404 :: Not Found"
                ]);
            break;
        }
    }
}
