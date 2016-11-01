<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;
use Uniplaces\STest\Requirement\StayTime;
use Uniplaces\STest\Requirement\TenantTypes;
use DateTime;

class ListingFinder implements ListingFinderInterface
{
    /**
     * @var string
     */
    protected $searchType;


    /**
     * @param string $searchType simple|advanced
     */
    public function __construct($searchType = 'simple')
    {
        $this->searchType = $searchType;
    }

    /**
     * @param Listing[] $listings
     * @param array     $search
     *
     * @return Listing[]
     */
    public function reduce(array $listings, array $search)
    {
        $matchListings = [];		
		
        foreach ($listings as $listing) 
		{
			$stillValid = $this->checkCity($listing, $search);	
			$stillValid = $stillValid && $this->checkStayTime($listing, $search);
			$stillValid = $stillValid && $this->checkTenantTypes($listing, $search);
			$stillValid = $stillValid && $this->handleSearchType($listing, $search);
       		
			if ($stillValid){
				$matchListings[] = $listing;
			}
		} 
		return $matchListings;
	}
	
	/**
     * @param Listing $listing
     * @param array    $search
	 * @param bool     $stillValid
     *
     * @return bool
     */
	protected function handleSearchType($listing, array $search)
	{	
	}
	
	/**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
	private function checkCity($listing, $search) 
	{		
		if ($listing->getLocalization()->getCity() != $search['city']) {
			return false;
		}
	    return true;
	}
	
	/**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
	private function checkStayTime($listing, $search) 
	{
        $stayTime = $listing->getRequirements()->getStayTime();		
		if (isset($search['start_date']) && $stayTime instanceof StayTime) {
                /** @var DateTime $startDate */
                $startDate = $search['start_date'];
                /** @var DateTime $endDate */
                $endDate = $search['end_date'];
                $interval = $endDate->diff($startDate);
                $days = (int)$interval->format('%a');

                if ($days < $stayTime->getMin() || $days > $stayTime->getMax()) {
                    return false;
                }
        }
		return true;
	}
	
	/**
     * @param Listing $listing
     * @param array    $search
     *
     * @return bool
     */
	private function checkTenantTypes($listing, $search) {
		$tenantTypes = $listing->getRequirements()->getTenantTypes();
		if ($tenantTypes instanceof TenantTypes && !in_array($search['occupation'], $tenantTypes->toArray())) {
                return false;
            }
		return true;	
	}	
}
