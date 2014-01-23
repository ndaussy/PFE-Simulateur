<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
	private $CI;
    private $var = array();
    
/*
|===============================================================================
| Constructeur
|===============================================================================
*/
    
   public function __construct()
{
	$this->CI =& get_instance();
	
	$this->var['output'] = '';
	
	//	Le titre est composé du nom de la méthode et du nom du contrôleur
	//	La fonction ucfirst permet d'ajouter une majuscule
	$this->var['titre'] = ucfirst($this->CI->router->fetch_method()) . ' - ' . ucfirst($this->CI->router->fetch_class());
	
	//	Nous initialisons la variable $charset avec la même valeur que
	//	la clé de configuration initialisée dans le fichier config.php
	$this->var['charset'] = $this->CI->config->item('charset');
	//a modifier avec fonction approprié framework
	$this->var['css'] = array(  base_url()."assets/css/style.css",
								base_url()."assets/css/bootstrap.min.css",
								base_url()."assets/css/bootstrap-responsive.min.css");

    $this->var['js_query'] = array(base_url()."assets/javascript/jquery-1.10.2.min.js");

    $this->var['js'] = array(

    						base_url()."assets/javascript/bootstrap.min.js",
                            base_url()."assets/javascript/highcharts.js",
                            base_url()."assets/javascript/highcharts-more.js",
                            base_url()."assets/javascript/exporting.js"

					    	);


   
  
}
/*
|===============================================================================
| Méthodes pour purger la view
|   . view
|   
|===============================================================================
*/
	public function reloadView()
    {
        $this->var['output'] = '';
    }




/*
|===============================================================================
| Méthodes pour charger les vues
|   . view
|   . views
|===============================================================================
*/
    
    public function view($name, $data = array())
    {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        
        $this->CI->load->view('../themes/default', $this->var);
    }
    
    public function views($name, $data = array())
    {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }

/*
|===============================================================================
| Méthode pour changes le nom de la pages
|   . Set_titre : nom de la page
|   . set_charset : Encodage
|===============================================================================
*/
        public function set_titre($titre)
		{
			if(is_string($titre) AND !empty($titre))
			{
				$this->var['titre'] = $titre;
				return true;
			}
			return false;
		}

		public function set_charset($charset)
		{
			if(is_string($charset) AND !empty($charset))
			{
				$this->var['charset'] = $charset;
				return true;
			}
			return false;
		}

/*
|===============================================================================
| Méthodes pour ajouter des feuilles de CSS et de JavaScript
|   . ajouter_css
|   . ajouter_js
|===============================================================================
*/
		public function ajouter_css($nom)
		{

		    if(is_string($nom) AND !empty($nom) AND file_exists('./assets/css/' . $nom . '.css') )
		    {
		    	//
		        $this->var['css'][] = css_url($nom);
		        return true;
		    }

		    return false;
		}
		public function ajouter_js($nom)
		{

		    if(is_string($nom) AND !empty($nom) AND file_exists('./assets/javascript/' . $nom . '.js'))
		    {
		        $this->var['js'][] = js_url($nom);
		        return true;
		    }
		    return false;
		}	

}

/* End of file layout.php */
/* Location: ./application/libraries/layout.php */