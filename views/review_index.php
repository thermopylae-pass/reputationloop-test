<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="script/review.js"></script>

<h1><?=$reviews_business_info_h1;?></h1>
<table>
	<tr>
		<th>Business Name: </th>
		<td><?=$business_info->business_name;?></td>
	</tr>
	<tr>
		<th>Business address: </th>
		<td><?=$business_info->business_address;?></td>
	</tr>
	<tr>
		<th>Business Phone: </th>
		<td><?=$business_info->business_phone;?></td>
	</tr>
	<tr>
		<th>External Page URL: </th>
		<td>
			<a href="<?=$business_info->external_page_url;?>"><?=$business_info->external_page_url;?></a>
		</td>
	</tr>
	<tr>
		<th>External URL: </th>
		<td><a href="<?=$business_info->external_url;?>">
			<?=$business_info->external_url;?></a>
		</td>
	</tr>
	<tr>
		<th>Total Avg Rating: </th>
		<td><?=$business_info->total_rating->total_avg_rating;?></td>
	</tr>
	<tr>
		<th>Total No Of Reviews: </th>
		<td><?=$business_info->total_rating->total_no_of_reviews;?></td>
	</tr>	
</table>
<h1><?=$reviews_reviev_h1;?></h1>
<table>
	<tr>
		<th>Customer Name</th>
		<th>Date of Submission</th>
		<th>Last Name</th>
		<th>Description</th>
		<th>Rating</th>
		<th>Review From</th>
		<th>Review URL</th>
		<th>Review ID</th>
		<th>Customer URL</th>
		<th>Review Source</th>
	</tr>
	<!-- traverse the reviews object and output accordingly -->
	<?php foreach ( $reviews as $pos => $review ) { ?>
	<tr>
			<td><?=$review->customer_name;?></td>
			<td><?=$review->date_of_submission;?></td>
			<td><?=$review->customer_last_name;?></td>
			<td><?=$review->description;?></td>
			<td><?=$review->rating;?></td>
			<td>
			<?php 
				switch ( $review->review_from ){
					case '0': 
						$review_from = 'Internal'; 
						break;
					case '1': $review_from = 'Yelp'; break;
					case '2': $review_from = 'Google'; break;
					default: $review_from = 'Internal'; break;
				}
			?>
			<?=$review_from;?>
				
			</td>
			<td><?=$review->review_url;?></td>
			<td><?=$review->review_id?></td>
			<td><a href="<?=$review->customer_url;?>"><?=$review->customer_url;?></a></td>
			<td><?=$review->review_source;?></td>
	</tr>
	<?php } ?>

	<table>
	</table>
</table>
<table><!-- setup our pagination -->
	<tr>
	<?php for ( $page=1; $page<=$total_no_of_pages; $page++ ) { 
		$offset = $page - 1;
		$offset = ($offset * 10) + 1;
		$_currentUrl = '/reputationloop-test/index.php?rt=review/index/?load=1&offset='.$offset.'&page='.$page;
		?>
		<th><a class="page_no" id="<?=$page;?>" href="<?=$_currentUrl;?>">[<?=$page;?>]</a></th>
	<?php } ?>
	<?php if ( $last_page_no_of_items > 0 ){ ?>
		<th><a class="page_no" id="<?=$page;?>" href="<?=$_currentUrl;?>">[<?=$total_no_of_pages+1;?>]</a></th>
		<?php } ?>
	</tr>
</table>