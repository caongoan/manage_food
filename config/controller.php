<?php 
	class Controller{
		public $view = NULL;
		public $layoutPath = NULL;
		public function loadView($viewPath,$data = NULL){
			//doc du lieu cua file $viewPath
			if(file_exists("views/$viewPath")){
				ob_start();
					if($data != NULL)
						extract($data);
					include "views/$viewPath";
					//neu co bien $layout thi gan vao bien $layoutPath cua class controller
					if(isset($layout))
						$this->layoutPath = $layout;
					$this->view = ob_get_contents();
				ob_get_clean();
			}
			//---
			if($this->layoutPath != NULL)
				include "views/$this->layoutPath";
			else
				echo $this->view;
		}
		//ham xac thuc dang nhap trang admin
public function authentication(){
		if(isset($_SESSION["admin_email"])==false)
			header("location:index.php?controller=login");
}
	}
 ?>