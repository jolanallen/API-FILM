<?php

use PHPUnit\Framework\TestCase;

class TMDBServiceTest extends TestCase {
    public function testGetMoviesReturnsNullOnInvalidUrl() {
        // TMDB_API_KEY est défini dans config/config.php qui est chargé par autoload
        $result = TMDBService::getMovies('invalid_type');
        $this->assertNull($result);
    }
}
