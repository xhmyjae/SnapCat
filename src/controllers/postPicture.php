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

class Post_Picture {
    public function execute(array $input): void
    {
        if (!isset($input['picture'])) {
            echo "error picture";
        }
        (new PostRepository())->postPicture();
        redirect('/homepage');
    }
}
