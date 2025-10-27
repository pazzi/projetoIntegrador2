{include file="header.tpl"}
{include file="nav.tpl"}

<div class="container mt-3 border border-secondary">
	<h3>Univesp Projeto Integrador II</h3>
	<h4>Sistema de Gestão de Arquivos Corporativos para Alpha 7</h4>
	<h5>Samuel Gustavo Guimarães - 23207740 - Engenharia da Computação<br>
		Carlos Benjamim Pazzianotto - 23201241 - Ciência de Dados</h5>
	<p>Linguagem de programação - PHP + Smarty Template - separar o código PHP do HTML</p>
	<p>Banco de Dados MySQL</p>
	<p>HTML-5 + Bootstrapp</p <h5>Disposição das páginas</h5>
	<p>Parte administrativa</p>
	<pre>
session.php
	inicio.php
			cadastro.php [novo]
			inicio.php[excluir]
			alterar_curso.php[alterar]

		municipios.php [link]
			cad_municipio.php[novo]
			municipios.php[excluir]
			alterar_municipio.php[alterar]
</pre>


	<p>Parte Publica</p>
	<pre>
index.php
	mostra_cursos.php

index_cidade.php
	mostra_cidade.php
</pre>

	<h4>Esquema do Banco de dados</h4>
	<img src="/docs/schema.png"></img>
	<h4>Fontes</h4>
	Fontes em <a href="github.com/pazzi/dm_ifsp">github.com/pazzi/dm_ifsp</a>
</div>

{include file="footer.tpl"}