<?php

require_once 'basic_doc.php';

/**
 * Description of AboutDoc
 *
 * @author Kevin de Vries
 */
class AboutDoc extends BasicDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  // Override functions from BasicDoc
  protected function bodyHeaderContent() {
    echo 'About';
  }

  protected function mainContent() {
    echo '<p>
            Mijn naam is Kevin de Vries. Ik ben 24 jaar oud en ik woon in Purmerend. <br>
            Ik ben in Amsterdam geboren, maar ik was naar Purmerend verhuisd toen ik
            nog op de basisschool zat. <br>
            Mijn moeder is Pools en ik ben tweetalig opgevoed, dus ik spreek Nederlands, Pools en Engels.
          </p>

          <h2>Opleidingen</h2>
          <p>
            Ik heb mijn bachelor in Natuur- en Sterrenkunde gedaan op de <abbr title="Universiteit van Amsterdam">UvA</abbr>. <br>
            Hier heb ik uiteindelijk vier jaar over gedaan, omdat ik mij in het 2<sup>de</sup> jaar realiseerde dat ik toch meer
            interesse had in informatica. <br>
            Ik heb dus het 3<sup>de</sup> en 4<sup>de</sup> van mijn bachelor gebruikt om zoveel mogelijk informatica vakken te volgen, <br>
            zoals Concurrency en Parallel Programmeren, Networks and Network Security en Besturingssystemen.
          </p>

          <p>
            Na mijn bachelor heb ik ook nog een master gedaan in Computational Science aan de
            <abbr title="Universiteit van Amsterdam">UvA</abbr> en aan de <abbr title="Vrije Universiteit Amsterdam">VU</abbr> (Joint Degree). <br>
            Tijdens mijn master ben ik veel in aanraking gekomen met zowel pure simulatievakken, zoals Agent Based Modelling
            en Complex System Simulation, <br> als Machine Learning en Data Science vakken, zoals Deep Learning en Data Mining Techniques.
          </p>

          <h2>Hobby\'s</h2>
          <ul>
            <li>Gaming</li>
            <li>Anime</li>
            <li>Leren over informatica gerelateerde onderwerpen zoals:</li>
            <ul>
              <li>programmeertalen</li>
              <li>datastructuren</li>
              <li>algoritmen</li>
            </ul>
          </ul>';
  }
}

?>