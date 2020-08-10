<?php namespace App\Controllers;
use App\Models\News;
//ini_set("memory_limit","1024M");
ini_set('max_execution_time', 300);

include '../app/Libraries/simple_html_dom.php';
class Simple extends BaseController
{
    public function test()
    {
        $news = new News();
        $gigs = addslashes('http://www.gigstix.com');
        $content = file_get_contents($gigs);
        if(!empty($content))
        {
            $html = new \simple_html_dom();
            $html->load($content);
            $count = 0;
            foreach($html->find('td.minifp') as $td)
            {
                $imagesrc = $td->find('img', 0)->src;
                $img = file_get_contents($imagesrc);

                $dog = $td->find('a', 1)->find('text', 0);
                $datum = $td->find('a', 1)->find('text', 1);
                $mesto = $td->find('a', 1)->find('text', 2);

                $link = $td->find('a', 1)->href;
                list($opis, $cena) = $this->detalji("$gigs$link");

                $duplikat = $news->where('Naziv', $dog)->find();
                if(isset($cena) && strlen($cena) < 5 && strlen($datum) < 14 && count($duplikat) < 1)
                {
                    $datum = date_create($datum);
                    $datum = date_format($datum, 'Y-m-d H:i:s');

                    //echo strlen($datum);

                    $news->insert(
                        [
                            'Naziv'=>$dog,
                            'Cena'=>(int)$cena,
                            'Datum'=>$datum,
                            'Lokacija'=>$mesto,
                            'Slika'=> $img,
                            'Tip'=>"M",
                            'Opis'=>$opis,
                        ]
                    );
                }


                if($count > 25) break;
                $count++;
            }

        }
    }

    private function detalji($link)
    {
        $content = file_get_contents($link);
        if (!empty($content)) {
            $html = new \simple_html_dom();
            $html->load($content);
            $start = $html->find('p.iteminfo', 0)->next_sibling()->next_sibling();
            $opis = "";
            while(!isset($start->class) && $start->tag!="div")
            {
                $p = $start->plaintext;
                $opis = "$opis$p<br>";
                $start = $start->next_sibling();

            }





            $curr = $html->find('p.sectiontableheader', 2);

            if(isset($curr))
            {
                $curr = $curr->next_sibling();
                while (!isset($curr->class))
                {
                    $text = explode('RASPRODATO!',$curr->plaintext);

                    if($text[count($text)-1] != ' ')
                    {

                        list($textcena, $cena) = $this->obrada($text[count($text) - 1]);
                        $opis = "$opis$textcena dinara";
                        return[$opis,$cena];
                    }

                    $curr = $curr->next_sibling();
                }

            }

        }

    }

    private function obrada($cena)
    {
        $text = explode('dinara', $cena);
        $opis = null;
        if(count($text) == 3)
        {
            $cenadog = filter_var($text[1], FILTER_SANITIZE_NUMBER_INT);
            $len = strlen(str_replace(" ", '', $text[1]));
            if($len == strlen($cenadog))
            {
                $staro = str_replace("-", '', filter_var($text[0], FILTER_SANITIZE_NUMBER_INT));
                $opis = str_replace($staro, $cenadog, $text[0]);
            }
            else
            {
                $cenadog = str_replace("-", '', filter_var($text[0], FILTER_SANITIZE_NUMBER_INT));
                $opis = $text[0];
            }
            return [$opis,$cenadog];
        }

        if(count($text) == 2)
        {
            $cenadog = str_replace("-", '', filter_var($text[0], FILTER_SANITIZE_NUMBER_INT));
            $opis = $text[0];
            return [$opis, $cenadog];
        }
        else return null;

    }

}