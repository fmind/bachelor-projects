<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view.
	 */
	public $layout='//layouts/main';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array(
        array('label'=>'Accueil', 'url'=>array('/admin/')),
        array('label'=>'Utilisateurs', 'url'=>array('/utilisateurs/admin')),
        array('label'=>'Catégories', 'url'=>array('/categories/admin')),
        array('label'=>'Sous-catégories', 'url'=>array('/sousCategories/admin')),
        array('label'=>'Aides', 'url'=>array('/aides/admin')),
        array('label'=>'Déconnexion', 'url'=>array('/admin/logout'))
    );

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}