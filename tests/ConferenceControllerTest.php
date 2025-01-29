<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }
    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(1, $crawler->filter('h2'));
        $client->clickLink('View');

        $this->assertPageTitleContains('Paris');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Paris');
    }
}