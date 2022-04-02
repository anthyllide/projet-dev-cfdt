<?php
/**
 * @file
 * Contains \Drupal\my_tree_filesPDF\Controller\MyTreeFilesPDFController.
 */

namespace Drupal\my_tree_filesPDF\Controller;
 
use Drupal\Core\Controller\ControllerBase;
 
class MyTreeFilesPDFController extends ControllerBase {

  protected $dir =  "";
  protected $title = "";

  //affiche les fichiers PDF
	public function displaylistPDF($theme) {

    $title = $this->modifyTitle($theme);
    $filesList = $this->readDirectory($theme);
    $repImg = drupal_get_path('module', 'my_tree_filesPDF');

    //var_dump(array_values($files)[0]);
   // var_dump(gettype(array_values($files)[0]));

    /* on vérifie si le tableau contient des sous-répertoires 
    en regardant si la première valeur du tableau est de type boolean, si oui, 
    alors le tableau ne contient pas de sous-répertoire.*/

    if(gettype(array_values($filesList)[0]) == boolean){

      $filesList1 = $filesList;

      //var_dump($filesList1);

    } else {

      $filesList2 = $filesList;
      $topicNew = ($this->tabDisplayNew($filesList2));

      //var_dump($topicNew);
    
    }


    return array(
      '#theme' => 'my_tree_filesPDF',
      '#title'=> $this->t($title),
      '#repImg'=> $this->t($repImg),
      '#files_tab1' => $filesList1,
      '#files_tab2' => $filesList2,
      '#topicNew_tab' => $topicNew
    );
	}

  //modifie le titre du sujet
  protected function modifyTitle($theme){

    $title = "";

    switch ($theme) {
      case "accords_cads":
        $title = "Accords CADS";
        break;
      case "accords_branche" :
        $title = "Accords de branche";
        break;
      case "CNN" :
        $title = "Convention collective nationale";
        break;
      case "CR_a_chaud_CSE_NAO" :
        $title = "Comptes-rendus à chaud CSE et NAO";
        break;
      case "qui_fait_quoi" :
        $title = "Qui fait quoi";
        break;
    }

    return $title;
  }

  //lit le répertoire passé en argument
  protected function readDirectory($theme) {

    $this->title = $this->modifyTitle($theme);
    $this->dir =  "public://pdf/".$this->title."/";

    $files = array(); //tableau de fichiers
    $directories = array(); //tableau des sous-répertoires
    $sortByDate = array();

    //var_dump($this->dir);

    if(is_dir($this->dir)){

      foreach (scandir($this->dir) as $value){ 
      
        //s'il existe d'autres fichiers que les fichiers . et .. 
        if (!in_array($value,array(".",".."))){ 

          if(is_dir($this->dir.$value)){

            $directories[] = $value;

          } else {

             if(file_exists($this->dir.$value)){

              $modifiedDate = $this->lastModifiedDate($this->dir.$value);

              $sortByDate [$value] = $modifiedDate;            

            }

          }

        }
      }

      

      //si l'array $directories n'est pas vide
      if(!empty ($directories)){

        foreach ($directories as $topic) {

          if(is_dir($this->dir.$topic)){

            foreach (scandir($this->dir.$topic) as $value){

              if (!in_array($value,array(".",".."))){ 

               // var_dump($dir.$topic."/".$value);

                if(file_exists($this->dir.$topic."/".$value)){

                  $modifiedDate = $this->lastModifiedDate($this->dir.$topic."/".$value);
                  
                   $sortByDate[$topic][$value] = $modifiedDate;

                }
              }
            }
          }
        }
      } 

        $files = $this->tabFilesSortByDate ($sortByDate);
        //var_dump($files);
    }

      //var_dump($files);
      return $files; // tableau de fichiers
  }

  protected function cutString($str){

    return substr($str,0, -4);

  }

  //retourne la dernière date de modification du fichier
  protected function lastModifiedDate($file){

    $modifiedDate = filemtime($file);

    return $modifiedDate;

  }

  //retourne true si la date actuelle (affiche un "new !" pendant 10 jours après la modification d'un document)
  protected function displayNew($dir,$value){

    //$dateLimit= strtotime('+10 days');

    $nowDate = strtotime('now');

    $lastModifiedDate = $this->lastModifiedDate($dir.$value);

    /* var_dump(date('d/m/Y',strtotime('now')));
     var_dump(date('d/m/Y', $this->lastModifiedDate($dir.$value)));
     var_dump(date('d/m/Y', strtotime('+10 days', $this->lastModifiedDate($dir.$value))));
     var_dump(strtotime('+10 days', $this->lastModifiedDate($dir.$value)) >= strtotime('now'));*/

    if (strtotime('+10 days', $lastModifiedDate) >= $nowDate){
      return true;
    } else {
      return false;
    }
  }

  //renvoit un tableau de booléen : s'il existe au moins un true dans dans un texte d'une sous-rubrique
  protected function tabDisplayNew(array $filesArray){

    $newList = array();

    foreach($filesArray as $subCat => $listDoc){

      if(in_array(true, array_values($listDoc))){
        $newList[$subCat] = true;
      } else {
        $newList[$subCat] = false;
      }     
    }

    return $newList;
  }

  //retourne un tableau $files classé par date de modification du plus récent au plus ancien
  protected function tabFilesSortByDate ($filesArray){

    $filesSortByDate = array();

    if( gettype(array_values($filesArray)[0]) == integer){ //on teste le type de $filesArray

      arsort($filesArray); //classement par date du plus récent au plus ancien

      foreach ($filesArray as $file => $value) {
        
        $paramNew = $this->displayNew($this->dir,$file);
            
        $file = $this->cutString($file);
            
        $filesSortByDate[$file] = $paramNew;
      }

    } else {

      foreach ($filesArray as $topic => $listFiles) {

        arsort($listFiles);

        foreach ($listFiles as $file => $value) {

          $paramNew = $this->displayNew($this->dir.$topic."/",$file);

          //var_dump($paramNew);
            
          $filee = $this->cutString($file);
            
          $filesSortByDate[$topic][$file]=$paramNew;
        }
      }

    }
      
      return $filesSortByDate;
  }

}
