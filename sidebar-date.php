<aside class="timeline">
	<?php

    if(isset($_GET['ye'])){$year = $_GET['ye'];} else {$year = date('Y'); }
    if(isset($_GET['mo'])){$month = $_GET['mo'];} else {$month = date('m');}

		if($month<9){
			$year_start = $year - 1;
			$year_end = $year;
		} else {
			$year_start = $year;
			$year_end = $year + 1;
		}
	?>
	<a href="?mo=<?php echo $month; ?>&ye=<?php echo $year - 1;?>" class="month arrow" id="">Prec.</a>
	<a href="?mo=09&ye=<?php echo $year_start;?>" class="month <?php month_selected('09', $year_start);?>" id="month_09">Sep</a>
	<a href="?mo=10&ye=<?php echo $year_start;?>" class="month <?php month_selected('10', $year_start);?>" id="month_10">Oct</a>
	<a href="?mo=11&ye=<?php echo $year_start;?>" class="month <?php month_selected('11', $year_start);?>" id="month_11">Nov</a>
	<a href="?mo=12&ye=<?php echo $year_start;?>" class="month <?php month_selected('12', $year_start);?>" id="month_12">Dec</a>
	<a href="?mo=01&ye=<?php echo $year_end;?>" class="month <?php month_selected('01', $year_end);?>" id="month_01">Jan</a>
	<a href="?mo=02&ye=<?php echo $year_end;?>" class="month <?php month_selected('02', $year_end);?>" id="month_02">Fev</a>
	<a href="?mo=03&ye=<?php echo $year_end;?>" class="month <?php month_selected('03', $year_end);?>" id="month_03">Mar</a>
	<a href="?mo=04&ye=<?php echo $year_end;?>" class="month <?php month_selected('04', $year_end);?>" id="month_04">Avr</a>
	<a href="?mo=05&ye=<?php echo $year_end;?>" class="month <?php month_selected('05', $year_end);?>" id="month_05">Mai</a>
	<a href="?mo=06&ye=<?php echo $year_end;?>" class="month <?php month_selected('06', $year_end);?>" id="month_06">Jun</a>
	<a href="?mo=07&ye=<?php echo $year_end;?>" class="month <?php month_selected('07', $year_end);?>" id="month_07">Jul</a>
	<a href="?mo=08&ye=<?php echo $year_end;?>" class="month <?php month_selected('08', $year_end);?>" id="month_08">Aou</a>
	<a href="?mo=<?php echo $month; ?>&ye=<?php echo $year + 1;?>" class="month arrow" id="">Suiv.</a>
</aside>
