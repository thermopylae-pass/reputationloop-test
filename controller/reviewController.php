<?php
/**
 * reviewController - the main controller to handle all matters related to Reputatin Loop test API url endpoint.
 *					Primarily responsible for accepting request/response to/from reputation loop 
 * 	@see API_URL
 */
class reviewController extends baseController {
	
	/**
	* @ITEMS_PEG_PAGE -  default no of records/items to show per page
	*/
	const ITEMS_PER_PAGE = 10;

	/**
	 * Reputation Loop base api test api url endpoint
	 */
	const API_URL = "http://test.localfeedbackloop.com/api?apiKey=61067f81f8cf7e4a1f673cd230216112";

	/**
	 * index - the default entry point method responsible for coordinating logic between the API endpoint and the
	 * requisite view
	 * @see /views/review_index.php
	 */
	public function index(){

		$review = '{}';	// holds the reviews object returned by Reputation Loop.

		$review = $this->fetchReview();
		
		if (isset( $review ) && !empty($review)){

		}
		$oReviews = json_decode($review);

		//initialize the business Info object and pass it to the view
		$this->registry->template->business_info = $oReviews->business_info;
		//initialize the reviews object and pass it to the the view
		$this->registry->template->reviews = $oReviews->reviews;

		$this->registry->template->total_no_of_pages = (int) round($oReviews->business_info->total_rating->total_no_of_reviews / self::ITEMS_PER_PAGE);
		$this->registry->template->last_page_no_of_items = (int) $oReviews->business_info->total_rating->total_no_of_reviews % self::ITEMS_PER_PAGE;
		$this->registry->template->reviews_business_info_h1 = 'Business Information';
		$this->registry->template->reviews_reviev_h1 = 'Reviews';

		//displkay the view with the Reviews
        $this->registry->template->show('review_index');
	}



	/**
	 * fetchReview - responsible for actuallyinvoking the call to reputation loop test url link.
	 * @return $review - json object.
	 */
	private function fetchReview(){
			$offset =  ( isset($_GET['offset'] )) ? $_GET['offset'] : 0;
	
			$url = self::API_URL."&noOfReviews=".self::ITEMS_PER_PAGE."&internal=1&yelp=1&google=1&offset=".$offset."&threshold=1";

			$review = file_get_contents($url);

			return( $review );
	}
}
