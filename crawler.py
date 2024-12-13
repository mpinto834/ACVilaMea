import requests
from bs4 import BeautifulSoup
import time

def extrair_dados_liga_pro(url):
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
        'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Language': 'pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7',
        'Connection': 'keep-alive'
    }
    
    try:
        print("Acessando a página...")
        response = requests.get(url, headers=headers)
        
        if response.status_code == 200:
            soup = BeautifulSoup(response.text, 'html.parser')
            
            # Encontrar todas as tabelas e pegar a segunda
            tabelas = soup.find_all('table', {'class': 'zztable'})
            if len(tabelas) > 1:
                tabela = tabelas[1]  # Pegar a segunda tabela
                
                print("\nClassificação:")
                print("Equipe | Pontos")
                print("-" * 30)
                
                # Extrair dados das equipes
                for tr in tabela.find_all('tr')[1:]:  # Pular o cabeçalho
                    colunas = tr.find_all('td')
                    if colunas:
                        nome_equipe = colunas[2].text.strip()  # Ajuste conforme necessário
                        pontos = colunas[3].text.strip()  # Ajuste conforme necessário
                        print(f"{nome_equipe} | {pontos}")
                
                return True
            else:
                print("Tabela de classificação não encontrada!")
                return None
            
        else:
            print(f"Erro ao acessar a página. Status code: {response.status_code}")
            return None
            
    except requests.RequestException as e:
        print(f"Erro ao acessar a página: {e}")
        return None

def main():
    # Colque aqui o URL exato da página que contém a tabela de classificação
    url = "https://www.zerozero.pt/competicao/af-porto-divisao-liga-pro-2383"  # Substitua esta linha com o URL correto
    print("Iniciando extração de dados...")
    dados = extrair_dados_liga_pro(url)

    input("\nPressione Enter para sair...")

if __name__ == "__main__":
    main()
