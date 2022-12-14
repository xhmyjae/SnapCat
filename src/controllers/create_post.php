<?php

namespace App\Controllers\post\Create;

require_once('src/model/post.php');

use App\Abstract\FlashMessage;
use App\Controllers\Homepage\PostRepository;
use App\Model\Homepage\HomepageController;
use App\Model\post\Create\CreatePost;
use App\Model\User\User;
use function App\Lib\Utils\redirect;

class Create_Post extends FlashMessage
{
    public function execute(array $input, User $connected_user, int $emotion): void
    {
        if (!isset($input['message'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        (new PostRepository())->createPost($input['message'], $connected_user->id, $emotion);
        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }

        $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a  crée un post\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);
        redirect('/homepage');
    }
}
