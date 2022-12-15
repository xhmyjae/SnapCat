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
    public function execute(array $input, User $connected_user): void
    {
        if (!isset($input['message'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }

        $emotion = $_POST['emotion'] ?? 1;

//        if (isset($_FILES['file']['tmp_name'])) {
        var_dump($_FILES);
        if(!empty(strlen($_FILES['file']['tmp_name']))) {
            $pictureFile = $_FILES;
            $pictureTmp = $pictureFile['file']['tmp_name'];
            $picture64 = base64_encode(file_get_contents($pictureTmp));
            $pictureExtension = pathinfo($pictureFile['file']['name'], PATHINFO_EXTENSION);
            $picture = 'data:image/' . $pictureExtension . ';base64,' . $picture64;
            if (!in_array($pictureExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->setFlashes('error', 'Le format de l\'image n\'est pas valide.');
                redirect('/homepage');
            }
        } else {
            $this->setFlashes('error', 'L\'image est trop volumineuse.');
            redirect('/homepage');
        }

        (new PostRepository())->createPost($input['message'], $connected_user->id, $picture ?? null, $emotion);

        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }

        $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a créé un post\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);
        redirect('/homepage');
    }
}
