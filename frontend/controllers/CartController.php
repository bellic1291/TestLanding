<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ItemsVariation;
use yii\web\HttpException;
use frontend\models\ContactForm;

class CartController extends Controller
{
    private $cart;
    
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cart = Yii::$app->cart;
    }
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }
    
    public function actionViewItems()
    {
        $model = new ContactForm;
        
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->addFlash('success', 'Заказ обрабатывается, мы свяжемся с Вами в ближайшее время!');
            return $this->goHome();
        } else {          
            return $this->render('view', [
                'cart' => $this->cart,
                'model' => $model,
            ]); 
        }
        
    }
    
    public function actionMinus()
    {
        if(!Yii::$app->request->isPost) {
            throw new HttpException(404 ,'Страница не найдена');
        }
        $id = Yii::$app->request->post('id');
        
        if($this->cart->getItem($id)->getQuantity() <= 1) {
            $this->cart->remove($id);
        } else {
            $this->cart->plus($id, -1);
        }
    }
    
    public function actionPlus()
    {
        if(!Yii::$app->request->isPost) {
            throw new HttpException(404 ,'Страница не найдена');
        }
        $id = Yii::$app->request->post('id');
        
        $this->cart->plus($id, 1);
    }
    
    public function actionRemove()
    {
        if(!Yii::$app->request->isPost) {
            throw new HttpException(404 ,'Страница не найдена');
        }
        $id = Yii::$app->request->post('id');
        
        try {
            $this->cart->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
        }
        return 'Успешно удалено';
    }
    
    public function actionClearItems()
    {
        if(!Yii::$app->request->isPost) {
            throw new HttpException(404 ,'Страница не найдена');
        }
        $this->cart->clear();
        return 'Корзина успешно очищена';
    }
    
    public function actionAddItem($id = 0)
    {
        if(!Yii::$app->request->isPost) {
            throw new HttpException(404 ,'Страница не найдена');
        }
        
        $id = Yii::$app->request->post('id');
        $product = ItemsVariation::find()->where(['id' => $id])->one();
        Yii::$app->cart->add($product, 1);
        return 'Товар успешно добавлен';
    }
}