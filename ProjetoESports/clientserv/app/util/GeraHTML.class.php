<?php

/**
 * <b>GeraHTML:</b>
 * Classe responsável por gerar o HTML referente à alguma seção PHP.
 * 
 * @copyright (c) 2016, Pedro Reis
 */
class GeraHTML {

    /**
     * @var string Caminho do template view em HTML
     */
    private $pag;
    /**
    * @var boolean Página criada ou não. Caso a página gerada/incluida($this->append) não exista o valor assume FALSE
    */
    private $flag;

    /** @param string $pag = Caminho do HTML para gerar o Template View */
    public function __construct($pag) {
        if (!file_exists($pag)):
            $this->flag = FALSE;
        else:
            $this->pag = file_get_contents($pag);
            $this->flag = TRUE;
        endif;
    }

    /** <b>Gera o HTML:</b> função responsável por retornar a página. (string) */
    public function get_pag() {
        if (!$this->flag)
            return NULL;
        return $this->pag;
    }

    public function set_pag($pag) {
        $this->pag = file_get_contents($pag);
    }

    /** <b>Verifica inclusão da página:</b> responsável por retornar a resposta booleana da geração de página */
    public function get_flag() {
        return $this->flag;
    }

    /**
     * <b>Conteudo dinamico:</b> função responsável pelo contéudo dinamico da TPL.
     * @param string $string Procura no HTML a KEY para gerar o conteudo dinamico.
     * @param string $replace Reescreve a string pelo conteudo dinamico. 
     */
    public function put($string, $replace) {
        $this->pag = str_replace($string, $replace, $this->pag);
    }

    /**
     * <b>Append:</b> Integra mais paginas ao HTML
     * @param string $pag
     */
    public function append($pag) {
        if (!file_exists($pag)):
            $this->flag = FALSE;
        else:
            $this->pag .= file_get_contents($pag);
            $this->flag = TRUE;
        endif;
    }

}
