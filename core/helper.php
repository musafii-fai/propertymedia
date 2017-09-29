<?php 
/**
* 
*/
class Helper
{
	public function pagination($result,$total_pages,$page,$search,$position = "left")
	{
		if ($position == "right") {
			$position = "pull-right";
		} else if ($position == "left") {
			$position = "pull-left";
		}

		if($result != []) :
			$pagePrev = $page - 1;
			$pageNext = $page + 1;
	    	// $search = isset($_GET["search"]) ? "&search=".$_GET["search"] : "";
			echo '<nav aria-label="...">';
				echo '<ul class="pagination pagination-lg '.$position.'">';
					$pagePrevDisabled = $page == 1 ? 'disabled' : '';
					echo '<li class="page-item '.$pagePrevDisabled.'">';
				      echo '<a class="page-link" href="?page=1'.$search.'">First</a>';
				    echo '</li>';
					echo '<li class="page-item '.$pagePrevDisabled.'">';
				      echo '<a class="page-link" href="?page='.$pagePrev.$search.'">Previous</a>';
				    echo '</li>';
				    	for ($i=1; $i <= $total_pages; $i++) :
				    		if (($i >= $page - 3) && ($i <= $page + 3)) {
					    		$pageActive = $page == $i ? 'active' : '';
							    echo '<li class="page-item '.$pageActive.'">';
							    	echo '<a class="page-link" href="?page='.$i.$search.'">'.$i.'</a>';
							    echo '</li>';
							}
				    	endfor;
					$pageNextDisabled = $page == $total_pages ? 'disabled' : '';
				    echo '<li class="page-item '.$pageNextDisabled.'">';
				      echo '<a class="page-link" href="?page='.$pageNext.$search.'">Next</a>';
				    echo '</li>';
				    echo '<li class="page-item '.$pageNextDisabled.'">';
				      echo '<a class="page-link" href="?page='.$total_pages.$search.'">Last</a>';
				    echo '</li>';
				echo '</ul>';
			echo '</nav>';
		endif;
	}
	
	public function alertSuccess($message) {
	    return '<div class="alert alert-success">'.$message.'. <i class="fa fa-check"></i></div>';
	}
	
	public function alertInfo($message) {
	    return '<div class="alert alert-info">'.$message.'. <i class="fa fa-info"></i></div>';
	}
	
	public function alertWarning($message) {
	    return '<div class="alert alert-warning">'.$message.'. <i class="fa fa-warning"></i></div>';
	}
	
	public function alertDanger($message) {
	    return '<div class="alert alert-danger">'.$message.'. <i class="fa fa-ban"></i></div>';
	}

	public function spanDanger($message)
	{
		return '<span style="color:red;">'.$message.'</span>';
	}
}

 ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 