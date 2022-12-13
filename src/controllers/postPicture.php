<?php

namespace App\Controllers\post\Create;

require_once('src/model/post.php');

use App\Abstract\FlashMessage;
use App\Controllers\Homepage\PostRepository;
use App\Model\Homepage\HomepageController;

use App\Model\post\Create\PostPicture;
use App\Model\User\User;
use RuntimeException;
use function App\Lib\Utils\redirect;

class Post_Picture extends FlashMessage {
    public function execute(array $input, User $connected_user, int $emotion): void
    {
        if (!isset($input['message'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        (new PostRepository())->postPicture($input['message'], $connected_user->id, $emotion);
        redirect('/homepage');
    }
}
