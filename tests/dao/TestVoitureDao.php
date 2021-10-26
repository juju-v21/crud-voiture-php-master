<?php
namespace Test\dao;
require_once '../../vendor/autoload.php';

use App\models\VoitureDao;
use PHPUnit\Framework\TestCase;

class TestVoitureDao extends TestCase {

    protected static $voitureDao;  
    
    public static function setUpBeforeClass() : void
    {
        TestVoitureDao::$voitureDao = new VoitureDao();
    }


    public function testFindAll () {
        $voitures = TestVoitureDao::$voitureDao->findAll();
        $this->assertEquals(count($voitures),3);
    }

    public function testfindById () {
        $voiture = TestVoitureDao::$voitureDao->findById (1);
        $this->assertNotNull($voiture);
    }

    public function testUpdateVoiture () {
        $voiture = TestVoitureDao::$voitureDao->findById (1);
        $voiture->setCouleur ("rouge");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        $voitureUpdated = TestVoitureDao::$voitureDao->findById (1);
        $this->assertEquals($voitureUpdated->getCouleur(),"rouge");
    }

    public function testDeleteVoiture () {
        $isDeleted = TestVoitureDao::$voitureDao->deleteVoiture (2);
        $this->assertTrue ($isDeleted);
    }

    public function testInsertVoiture(){
        $isAdd = TestVoitureDao::$voitureDao->insertVoiture2(4, "BR351CU", "mat", "Lambobo", "sportGTXZY");
        $this -> assertNotNull($isAdd);
    }


    public static function tearDownAfterClass () : void
    {
        $voiture = TestVoitureDao::$voitureDao->findById (1);
        $voiture->setCouleur ("rose");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        TestVoitureDao::$voitureDao->insertVoiture2(2, "FR351CU", "Noir-mat", "Lambo", "sport");
        TestVoitureDao::$voitureDao->deleteVoiture(4);
    }

}
