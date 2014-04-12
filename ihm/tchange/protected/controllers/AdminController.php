<?php

class AdminController extends Controller
{
    public $layout = "//layouts/admin";

    /**
     * Welcome to admin interface
     */
    public function actionIndex() {
        if (!Yii::app()->user->isGuest)
            $this->render('index');
        else
            $this->redirect(array('login'));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm(true);

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(array('admin/index'));
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

	/**
	 * Logs out the current user and redirect to admin page.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('index');
	}
}