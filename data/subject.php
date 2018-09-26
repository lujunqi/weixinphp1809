<?php
$subjects=array("语文","数学","体育","美术","音乐","科学","道德","英语");
$subjectslength=count($subjects);

for($x=0;$x<$subjectslength;$x++) {
	if($subjects[$x] == $def_subject){
		echo "<option value='$subjects[$x]' selected='selected'>$subjects[$x]</option>";
	}else{
		echo "<option value='$subjects[$x]'>$subjects[$x]</option>";
	}
	
}

?>