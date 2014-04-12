<?php

class MessagesController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

    /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow',
				'users'=>array('@'),
                'actions'=>array('question'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Pose une question à un utilisateur concernant un objet
     */
    public function actionQuestion()
    {
        $model = new Messages('question');

        // Peut on faire plus laid ...
		if(isset($_POST['Messages']))
		{
            $message = new Messages();
			$message->attributes=$_POST['Messages'];
			if($message->validate() && $message->save())
            {
                ;
            }
            else
            {
                echo "Votre message n'a pas put être envoyé:";
                foreach ($message->getErrors() as $error)
                {
                    foreach ($error as $message)
                        echo "\n- ".$message;
                }
            }
		}
        else
        {
            $utilisateur = Utilisateurs::connecte();

            $model->source = $utilisateur->id;
            $model->destinataire = $_GET['destinataire'];
            $model->bien = $_GET['bien'];
            $model->message = 'Saisissez ici votre question';
            $this->renderPartial('_question', array(
                'model' => $model,
            ));
        }
    }
}
