<?php 
	require('api.php');
	
	if(!isset($_GET['page']))
	{
		$_GET['page'] = 1;
	}
	
	$page = $_GET['page'];
	
	require('header.php');
?>
                <div class="centered"><?php require('pageselector.php');?></div>
                <br>
                <?php
                	$firstQuoteID = 10 * ($pages - $page + 1);
                	$secondQuoteID = $firstQuoteID > 9 ? $firstQuoteID - 9 : 0;
                	$quotes = $mysql->query("SELECT * FROM quotes WHERE id>=".$secondQuoteID." AND id<=".$firstQuoteID." AND approved=1 ORDER BY id DESC");
                	
                	while($quote = $quotes->fetch_assoc())
                	{
                		$id = $quote['id'];
                		$time = $quote['time'];?>
                		<div class="quote">
                			<h4><a href="viewquote.php?id=<?php echo $id;?>"><b>#<?php echo $id;?> - <?php echo $quote['title'];?></b></a></h4>
                			<h5><b>Submitter:</b> <?php echo $quote['submitter']?> - <b>Date:</b> <?php echo gmdate('l F jS, Y, g:i A T', $time);?></h5>
                			<h6><?php echo nl2br(formatQuote($quote['quote'], array(
                					array('<', '&lt;'),
                					array('>', '&gt;'),
                					array('�', '&deg;'),
                					array('�', '&sup3;')
                			)));?></h6>
                		</div>
                		<br>
                <?php }?>
                <br>
                <div class="centered"><?php require('pageselector.php');?></div>
            </div>
        </div>
    </body>
</html>