<?php

class TestAction extends CommonAction{

 public function index(){
        echo "<script type='text/javascript'>
          
         var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
</script>";
     $this->display();
}

}