<?php
class Stipendio
{
    private $mensile;
    private $tredicesima;
    private bool $quattordicesima;
    public function __construct($mensile, bool $tredicesima, bool $quattordicesima)
    {
        $this->setMensile($mensile);
        $this->setTredicesima($tredicesima);
        $this->setQuattordicesima($quattordicesima);
        $this->stipendioAnnuale();
    }
    public function setMensile($mensile)
    {
        $this->mensile = $mensile;

    }
    public function getMensile()
    {
        return $this->mensile;

    }

    public function setTredicesima($tredicesima)
    {
        $this->tredicesima = $tredicesima;

    }
    public function getTredicesima()
    {
        return $this->tredicesima;


    }
    public function setQuattordicesima($quattordicesima)
    {
        $this->quattordicesima = $quattordicesima;

    }
    public function getQuattordicesima()
    {
        return $this->quattordicesima;

    }
    public function stipendioAnnuale()
    {
        if ($this->getTredicesima() === false && $this->getQuattordicesima() === false) {
            return $this->getMensile() * 12;
        } else if ($this->getTredicesima() === true && $this->getQuattordicesima() === true) {
            return ($this->getMensile() * 12) + $this->getMensile() * 2;

        }
          else if ($this->getTredicesima() === true && $this->getQuattordicesima() === false) {
            return ($this->getMensile() * 12) + $this->getMensile();

        }


    }
    public function getHtml()
    {
        return "</h1>" . "Mensile : " . $this->getMensile() . "<br>" . "Stipendio annuale :" . $this->stipendioAnnuale();
    }
}
class Persona
{
    private $nome;
    private $cognome;
    private $dataNascita;
    private $luogoNascita;
    private $codFiscale;

    public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $codFiscale)
    {
        $this->setNome($nome);
        $this->setCognome($cognome);
        $this->setDataNascita($dataNascita);
        $this->setLuogoNascita($luogoNascita);
        $this->setCodFiscale($codFiscale);


    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }
    public function getCognome()
    {
        return $this->cognome;
    }
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    }
    public function getDataNascita()
    {
        return $this->dataNascita;
    }
    public function setLuogoNascita($luogoNascita)
    {
        $this->luogoNascita = $luogoNascita;
    }
    public function getLuogoNascita()
    {
        return $this->luogoNascita;
    }
    public function setCodFiscale($codFiscale)
    {
        $this->codFiscale = $codFiscale;
    }
    public function getCodFiscale()
    {
        return $this->codFiscale;
    }
    public function getHtml()
    {
        return "Nome : " . $this->getNome() . "<br>" . "Cognome : " . $this->getCognome() . "<br>" . "Data di nascita : " . $this->getDataNascita() . "<br>" . "Luogo di nascita : " . $this->getLuogoNascita() . "<br>" . "Codice Fiscale : " . $this->getCodFiscale() . "<br>";
    }

}
class Impiegato extends Persona
{
    private Stipendio $stipendio;
    private $dataAssunzione;
    public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $codFiscale, Stipendio $stipendio, $dataAssunzione)
    {
        parent::__construct($nome, $cognome, $dataNascita, $luogoNascita, $codFiscale);
        $this->setStipendio($stipendio);
        $this->setDataAssunzione($dataAssunzione);
    }
    public function setStipendio($stipendio)
    {
        $this->stipendio = $stipendio;
    }
    public function getStipendio()
    {
        return $this->stipendio->stipendioAnnuale();
    }
    public function setDataAssunzione($dataAssunzione)
    {
        $this->dataAssunzione = $dataAssunzione;
    }
    public function getDataAssunzione()
    {
        return $this->dataAssunzione;
    }
    public function getHtmlImpiegato()
    {
        return "<h1>" . $this->getHtml() . "Stipendio Annuale : " . $this->getStipendio() . " €" . "</h1>";
    }


}
class Capo extends Persona
{
    private $dividendo;
    private $bonus;
    public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $codFiscale, $dividendo, $bonus)
    {
        parent::__construct($nome, $cognome, $dataNascita, $luogoNascita, $codFiscale);
        $this->setDividendo($dividendo);
        $this->setBonus($bonus);
    }
    public function setDividendo($dividendo)
    {
        $this->dividendo = $dividendo;
    }
    public function getDividendo()
    {
        return $this->dividendo;
    }
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;
    }
    public function getBonus()
    {
        return $this->bonus;
    }
    public function redditoAnnuale()
    {
        return ($this->getDividendo() * 12) + $this->getBonus();
    }
    public function getHtmlCapo()
    {
        return "<h1>" . $this->getHtml() . "Dividendo : " . $this->getDividendo() . "<br>" . "Bonus : " . $this->getBonus() . "<br>" . "Reddito Annuale : " . $this->redditoAnnuale() . "</h1>";
    }


}
$stipendio1 = new Stipendio(1500, true, true);
$impiegato1 = new Impiegato("Luca", "Vitale", "2000-08-16", "Brindisi", "VTLLC48AS5", $stipendio1, "2022-01-01");
$capo1 = new Capo("Mario", "Rossi", "1954-10-12", "Roma", "AK39CB0RE45", 1600, 350);

echo $impiegato1->getHtmlImpiegato();
echo "<br><br>--------------------------------<br><br>";
echo $capo1->getHtmlCapo();