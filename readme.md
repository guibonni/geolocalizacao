# Geolocalização Simples

Projeto simples usado como proxy para outra API de geolocalização, traduzindo o nome das chaves para português e futuramente implementando um sistema de caching pra evitar requisições repetidas.

## Como usar

Esse projeto basicamente faz uma chamada GET para outra API, e "arruma" o JSON em um formato mais simples para pegar apenas o endereço, passando a latitude e a longitude como parâmetros.

### Requisitos

Todas as buscas são feitas no servidor do Nominatim, então devem ser respeitados os requisitos deles para usar o serviço de forma gratuita, principalmente no limite de 1 chamada por segundo. Para mais informações, consultar a política de uso do Nominatim em: https://operations.osmfoundation.org/policies/nominatim/

### Exemplo

Para utilizar o serviço só é necessário informar a latitude e a longitude do endereço, e ele retorna um JSON com o endereço completo.

```
http://localhost/geolocalizacao/api/endereco/buscar.php?lat=-23.5878333&lon=-46.6578463
```

## Autor

* **Gui Castro**

## Observações

* Esse projeto foi feito como um treinamento, então qualquer crítica/sugestão/melhoria será bem vinda
* Eu utilizei o site https://wiki.openstreetmap.org/wiki/Nominatim para ver como API do Nominatim funciona, e a API que faz a busca de endereços é deles. Esse projeto é apenas um intermediário.

