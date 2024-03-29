@echo off

echo Criando pasta Webapp...
mkdir "C:\Program Files (x86)\VertrigoServ\www\webapp"
echo.
echo Copiando pasta webapp...
xcopy C:\Projetos\voting\voting-3.0.0\webapp "C:\Program Files (x86)\VertrigoServ\www\webapp" /s /y
echo.

echo Criando pasta dao...
mkdir "C:\Program Files (x86)\VertrigoServ\www\dao"
echo.
echo Copiando pasta dao...
xcopy C:\Projetos\voting\voting-3.0.0\dao "C:\Program Files (x86)\VertrigoServ\www\dao" /s /y
echo.

echo Criando pasta model...
mkdir "C:\Program Files (x86)\VertrigoServ\www\model"
echo.
echo Copiando pasta model...
xcopy C:\Projetos\voting\voting-3.0.0\model "C:\Program Files (x86)\VertrigoServ\www\model" /s /y
echo.

echo Criando pasta util...
mkdir "C:\Program Files (x86)\VertrigoServ\www\util"
echo.
echo Copiando pasta util...
xcopy C:\Projetos\voting\voting-3.0.0\util "C:\Program Files (x86)\VertrigoServ\www\util" /s /y
echo.

echo Criando pasta graph...
mkdir "C:\Program Files (x86)\VertrigoServ\www\webapp\graph"
echo.

echo Criando pasta jbgraph...
mkdir "C:\Program Files (x86)\VertrigoServ\www\webapp\jpgraph"
echo.
echo Copiando pasta jpgraph...
xcopy C:\Projetos\voting\voting-3.0.0\jpgraph "C:\Program Files (x86)\VertrigoServ\www\jpgraph" /s /y
echo.

IF ERRORLEVEL 1 (
	echo Erro ao copiar a pasta webapp.
	echo.
)

echo Copiando index.php...
xcopy C:\Projetos\voting\voting-3.0.0\index.php "C:\Program Files (x86)\VertrigoServ\www" /y
echo.

echo Gerando arquivo de deploy .ZIP
cd C:\Projetos\voting\voting-3.0.0
7z a -oc:\projetos\voting\voting-3.0.0 deploy.zip
7z d deploy.zip .settings assets database script .project deploy.zip
echo.

IF ERRORLEVEL 1 (
	echo Ocorreram erros no processo de copia dos arquivos.
	echo.
) ELSE (
	echo.
	echo Bat executado com sucesso.
	echo.
)
pause