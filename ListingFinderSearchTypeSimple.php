<?php

namespace Uniplaces\STest;

final class ListingFinderSearchTypeSimple extends ListingFinder
{
	protected function handleSearchType($listing, array $search)
  {	 
	return true;
  }
}
