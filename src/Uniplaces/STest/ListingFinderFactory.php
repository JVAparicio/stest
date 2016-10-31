<?php

namespace Uniplaces\STest;

/**
 * ListingFinderFactory
 */
abstract class ListingFinderFactory
{
    /**
     * @return ListingFinderInterface
     */
    public static function createSimple()
    {
        return new ListingFinderSearchTypeSimple();
    }

    /**
     * @return ListingFinderInterface
     */
    public static function createAdvanced()
    {
        return new ListingFinderSearchTypeAdvanced();
    }
}
