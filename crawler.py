import requests
from bs4 import BeautifulSoup
import time
import os
import json

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
            
            tabelas = soup.find_all('table', {'class': 'zztable'})
            
            equipas = []
            if len(tabelas) > 1:
                tabela = tabelas[1]  #segunda tabela
                print("\nClassificação:")
                print("Equipe | Pontos")
                print("-" * 30)
                
                # Extrair dados das equipas
                for tr in tabela.find_all('tr')[1:]:  
                    colunas = tr.find_all('td')
                    if colunas:
                        nome_equipa = colunas[2].text.strip() # nome das equipas
                        pontos = int(colunas[3].text.strip()) # pontos de cada equipa
                        print(f"{nome_equipa} | {pontos}")
                        equipas.append({'nome': nome_equipa, 'pontos': pontos})
                
                return json.dumps(equipas)  # Retorna como JSON
            else:
                print("Tabela de classificação não encontrada!")
                return json.dumps([])  # Retorna JSON vazio
            
        else:
            print(f"Erro ao acessar a página. Status code: {response.status_code}")
            return json.dumps([])
            
    except requests.RequestException as e:
        print(f"Erro ao acessar a página: {e}")
        return json.dumps([])  # Retorna JSON vazio

def main():
    url = "https://www.zerozero.pt/competicao/af-porto-divisao-liga-pro-2383" 
    print("Iniciando extração de dados...")
    dados = extrair_dados_liga_pro(url)


    # Certifica-se de imprimir apenas os dados JSON para que o PHP possa capturá-los
    print(dados)

if __name__ == "__main__":
    main()
