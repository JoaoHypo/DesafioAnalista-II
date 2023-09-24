# DesafioAnalista-II
<h1>API de consulta a API da Marvel.</h1>
<img src="1.png" alt="1">
<p>Eescolhendo 3 heróis, extraia suas imagens e 5 histórias aleatórias atreladas ao seus dados da api.</p>
</>A Api da Marvel devolve suas requests em json.</p>

<h2>Setup do desenvolvimento:</h2>
<p>(É um note dell antigo que tem estética de 1 macbook dos antigos,vulgo Gigatosh)</p>
<img src="gigatosh.png" alt="Gigatosh">
<h2>Porque XAMPP (Cross-platform, Apache, MySQL, PHP, Perl)?</h2>

<p>O XAMPP é uma solução multiplataforma, o que significa que pode ser executado em sistemas operacionais como Windows, macOS e Linux.</p>

<p>Além do Apache, MySQL (ou MariaDB), PHP e Perl, o XAMPP também inclui outras ferramentas como FileZilla FTP Server e Mercury Mail Server, o que torna uma opção mais abrangente para desenvolvedores que precisam de várias ferramentas adicionais.</p>

<h2>Instalando XAMPP:</h2>

<p>Acesse: <a href="www.apachefriends.org">www.apachefriends.org</a></p>

<p>Baixe a versão para plataforma desejada.</p>

<p>Neste projeto utilizamos: XAMPP 8.2.4 Para linux.</p>

<p>PHP 8.2.4, 8.1.17 e 8.0.28<br>
Apache 2.4.56<br>
MariaDB 5.4.28<br>
phpMyAdmin 5.2.1<br>
OpenSSL 1.1.1t</p>

<p>No ambiente linux é necessário tornar executável o arquivo baixado, abrindo o terminal, navegando até a pasta onde foi baixado o arquivo de instalação .run e utlizando o comando sudo chmod +x nome-do-arquivo-baixo<br>
Digite em seguida sua senha do linux, e execute o .run com<br>
sudo ./nome-do-arquivo-baixado</p>

<p>Na instalação é só avançar até o final com as configurações recomendadas.</p>

<p>Finalizada a instalação, vamos criar um executável para o XAMPP</p>

<p>(Caso vá copiar os comandos, cuidado ao colar no terminal para que não falte nada ou envie o comando com algum espaço a mais, isso junto ao comando sudo pode acabar criando algum diretório ou arquivo novo com nome*quase igual*)</p>

<p>na home ~ vamos até cd .local/share/applications</p>

<p>criando o XAMPP com touch xampp.desktop</p>

<p>agora editando, vim xampp.desktop</p>

<p>Inserimos:</p>
<pre>
[Desktop Entry]
 Encoding=UTF-8
 Name=XAMPP Control Panel
 Comment=Start and Stop XAMPP
//pode adicionar sudo no início desse comando caso prefira:
 Exec=/opt/lampp/manager-linux-x64.run 
 Icon=/opt/lampp/htdocs/favicon.ico
 Categories=Application
 Type=Application
 Terminal=true
</pre>

<p>Agora têmos um atalho no menu do Ubuntu!</p>

<p>Ainda em .local/share/applications, para que consigamos utilizar o PHP instalado junto ao XAMPP, precisamos ajustar criando um link simbólico nos os binários do nosso OS(onde ficam os executáveis), com o seguinte comando:</p>

<p>sudo ln -s /opt/lampp/bin/php /usr/bin/php</p>

<h3>Ajustando diretório do Apache:</h3>

<p>No terminal:</p>

<p>sudo vim /opt/lampp/apache2/conf/httpd.conf</p>

<p>Vamos alterar a linha 4, substituindo a string do diretório:</p>

<pre>
“/home/seu-user/resto-do-caminho-até-seu-diretório”
</pre>

<h3>Ajustando user de execução:</h3>

<p>sudo vim /opt/lampp/etc/httpd.conf</p>

<p>Linhas 173 e 174, vamos trocar daemon para nosso user.</p>
<p>E nas linhas 229 e 230 vamos alterar document root e Directory para o diretório em que decidimos trabalhar, o mesmo ajustado no apache.</p>

<p>Pronto, agora é inserir seus arquivos dentro da pasta recém configurada e botar pra rodar!</p>
<p>Caso queira testar este projeto, basta abrir um terminal dentro do diretório configurado, e utilizar o comando git clone deste repo.</p>

<p>Lembrando que isso criará uma subpasta dentro do seu ambiente apache, que trata a pasta inserida anteriormente nos arquivos de programação como a raiz do servidor, então para acessar deverá no seu navegador, depois de clonado o repo e inicializado seu XAMPP, acessar localhost/DesafioAnalista-II.</p>

<p>Ou acessar a pasta do DesafioAnalista-II, e pelo terminal,e subir todo conteúdo 1 diretório, a fim de tornar acessível a aplicação na raiz do localhost.</p>

<p>Exemplo:</p>
<pre>
user@nomePC:~/caminhoConfigurado/DesafioAnalista-II$
</pre>

<p>Comando para subir 1 diretório todo conteúdo da pasta atual:</p>
<pre>
sudo mv * ..
</pre>

<h2>Entendendo a API da Marvel:</h2>

<p>Primeiramente deve criar sua conta e solicitar suas api keys.</p>

<p>Com elas em mãos, devemos consultar a seguinte orientação:</p>

<h3>Autenticação para Aplicações no Lado do Servidor</h3>

<p>“Aplicações no lado do servidor devem enviar dois parâmetros além do parâmetro "apikey":</p>

<p>ts - um carimbo de data/hora (ou outra sequência longa que possa ser alterada a cada solicitação)</p>
<p>hash - um resumo md5 do parâmetro "ts", sua chave privada e sua chave pública (por exemplo, md5(ts+chavePrivada+chavePública))</p>

<p>Por exemplo, um usuário com uma chave pública "1234" e uma chave privada "abcd" poderia construir uma chamada válida da seguinte forma: http://gateway.marvel.com/v1/public/comics?ts=1&apikey=1234&hash=ffd275c5130566a2916217b101f26150 (o valor do hash é o resumo md5 de 1abcd1234)”</p>

<h3>Com sua chave em mãos, e  sua timeStamp, podes montar sua chave em formato md5.</h3>

<p>Apartir daí é desenvolver da forma que preferir, sua aplicação.</p>
<p>No caso desse desafio utilizamos os métodos :</p>

<p>GET - /v1/public/characters</p>
<p>GET - /V1/public/characters/{characterId}/stories</p>

<p>Estes métodos foram implementados em php utilizando a bibliteca cURL (Client URL Library).</p>

<p>Outros métodos disponíveis em: <a href="https://developer.marvel.com/docs">https://developer.marvel.com/docs</a></p>

<h3>Por último, caso você vá clonar este repo, seria bom gerar suas próprias keys e substituir pelas minhas.<br>
 As chaves possuem limite de uso diário.</h3>
