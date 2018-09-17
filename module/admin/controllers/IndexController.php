<?php
declare(strict_types=1);

namespace app\module\admin\controllers;

use app\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    use AdminTrait;

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * @param int $page
     * @return string|\yii\web\Response
     */
    public function actionPhoto(int $page)
    {
        if ($page !== 0) {
            return $this->render('photo', [
                'page' => $page
            ]);
        }
        return $this->redirect(['/admin/index/photo?page=1']);
    }

    public function actionCreatephoto()
    {
        $img = new UploadForm();
        $message = "";
        $post = Yii::$app->request->post("UploadForm");
        if (!empty($post)) {
            $img->imageFile = UploadedFile::getInstance($img, 'imageFile');
            $img->directory = $post["directory"];
            if ($img->upload()) {
                // file is uploaded successfully
                return $this->redirect(['/admin/index/photo?page=1']);
            }
            $message = "<p style='color: red'><b>Нажаль фотографія не завантажилася</b></p>";
        }
        return $this->render('createphoto', [
            "img" => $img,
            "message" => $message
        ]);
    }

    /**
     * @param string $filename
     * @param int $page
     * @return string|\yii\web\Response
     */
    public function actionDeletephoto(string $filename, int $page)
    {
        $filename = glob($filename);
        $filename = $filename[0];

        $file_parts = explode(".", $filename);          //разделить имя файла и поместить его в массив
        $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение

        if (is_file($filename) && in_array($ext, $this->allowedTypes)) {
            // ...удаляем его.
            unlink($filename);

            // Если файла нет по запрошенному пути, возвращаем TRUE - значит файл удалён.
            if (!file_exists($filename)) {
                return $this->redirect('/admin/index/photo?page=' . $page);
            }

            return $this->redirect(['/admin/index/photo?page=1']);
        }
    }
}
