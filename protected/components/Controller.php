<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public static function alenaModal( $id, $variables = array() ) {
        $obj_variables = (object) $variables;

        if( !isset($obj_variables->title) )
            $obj_variables->title = "";
        if( !isset($obj_variables->body) )
            $obj_variables->body = "";
        if( !isset($obj_variables->footer) )
            $obj_variables->footer = "";
        if( !isset($obj_variables->style) )
            $obj_variables->style = "";
        if( !isset($obj_variables->class) )
            $obj_variables->class = "";

        $modal_string = <<<EOF
        <div class="modal fade" id="{$id}">
            <div class="modal-dialog" style="{$obj_variables->style}">
                <div class="card modal-content {$obj_variables->class}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title"><div>{$obj_variables->title}</div></h3>
                    </div>
                    <div class="container"></div>
                    <div class="modal-body">{$obj_variables->body}</div>
                    <div class="modal-footer">{$obj_variables->footer}</div>
                </div>
            </div>
        </div>
EOF;
        return $modal_string;
    }


    // To Remove
    /*
    public static function modalDiv( $id, $variables = array() ) {
        $obj_variables = (object) $variables;

        if( !isset($obj_variables->title) )
            $obj_variables->title = "";
        if( !isset($obj_variables->body) )
            $obj_variables->body = "";
        if( !isset($obj_variables->footer) )
            $obj_variables->footer = "";
        if( !isset($obj_variables->style) )
            $obj_variables->style = "";
        if( !isset($obj_variables->class) )
            $obj_variables->class = "";

        $modal_string = <<<EOF
        <div class="modal fade" id="{$id}">
            <div class="modal-dialog" style="{$obj_variables->style}">
                <div class="modal-content {$obj_variables->class}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title"><div>{$obj_variables->title}</div></h3>
                    </div>
                    <div class="container"></div>
                    <div class="modal-body">{$obj_variables->body}</div>
                    <div class="modal-footer">{$obj_variables->footer}</div>
                </div>
            </div>
        </div>
EOF;
        return $modal_string;
    }

    public static function faDivMenu( $drawing_class, $title ) {
    $divmenu = <<<EOF
     <div class="col-lg-3 col-xs-6">
            <div class="panel panel-customize">
                <div class="panel-heading">
                    <div class="row">
                     <div class="text-center">
                            <i class="fa {$drawing_class} fa-4x"></i>
                            <div class="text-center">
                                <h4>{$title}</h4>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
EOF;
    return $divmenu;
}

  */

    public static function datePicker( $id, $dateformat='', $text_fields ) {
        $datepick = <<<EOF
        <div class='input-group date' id='{$id}'>
            {$text_fields}
            <span class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
EOF;
        Yii::app()->clientScript->registerScript("datetimepicker{$id}", "
            $(function () {
							var currentDate = new Date();
							var curYear = currentDate.getFullYear();
							var curMonth = currentDate.getMonth();
							var curDay = currentDate.getDay();
							var minDate = getFormatDate(new Date(currentDate.setDate(currentDate.getDate())));
	 						var maxDate = getFormatDate(new Date(currentDate.setDate(currentDate.getDate() + 7)));
							//alert(maxDate);

                 $('#{$id}').datetimepicker( {
									 format: '{$dateformat}',
								 	 minDate: moment(minDate, 'MM/DD/YYYY') ,
	 						 		 maxDate: moment(maxDate, 'MM/DD/YYYY')  ,
									 //disabledDates: [ moment('curYear (curMonth + 2) 3', 'MM/DD/YYYY')  ],
									ignoreReadonly: true,
									sideBySide: true ,
							 	});
            });

					function getFormatDate(d){
						return d.getMonth()+1 + '/' + d.getDate() + '/' + d.getFullYear()
					}
        ");

        return $datepick;
    }
	
	public static function Checkaccess() {
        // for fleet user dept only
        $check_id = Yii::app()->user->id;
        $roles = Authassignment::model()->findAllByAttributes(array('userid'=>$check_id));
        if(count($roles)>0){
			foreach($roles as $role){
				if ($role->itemname == "rxClient") 
	                return 'hidden';
			}
		}
            
		

        return 'visible';
    }

    public static function faDivMenu( $drawing_class, $title ) {
        $divmenu = <<<EOF
        <div class="col-lg-3 col-xs-6">
            <div class="panel panel-customize">
                <div class="panel-heading">
                    <div class="row">
                        <div class="text-center">   
                            <i class="fa {$drawing_class} fa-4x"></i>
                            <div class="text-center">
                                <h4>{$title}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
EOF;
    return $divmenu;
}



}
