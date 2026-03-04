<?php

use PHPUnit\Framework\TestCase;

class TMDBServiceTest extends TestCase {
    public function testGetMoviesReturnsNullOnInvalidUrl() {
        $result = TMDBService::getMovies('invalid_type');
        $this->assertNull($result);
    }
}
