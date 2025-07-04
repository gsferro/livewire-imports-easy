<p align="center">
    <img src="logo.png" alt="FilterEasy">
    <p align="center">
        <a href="https://packagist.org/packages/gsferro/livewire-import-easy"><img alt="Latest Version" src="https://img.shields.io/packagist/v/gsferro/livewire-import-easy"></a>
        <a href="https://packagist.org/packages/gsferro/livewire-import-easy"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/gsferro/livewire-import-easy"></a>
        <a href="https://packagist.org/packages/gsferro/livewire-import-easy"><img alt="License" src="https://img.shields.io/packagist/l/gsferro/livewire-import-easy"></a>
    </p>
</p>

------

## Introdução
Componente Livewire pronto para importação de arquivos de forma easy

## Pre-requisitos
| Package  | Version 
|----------|---------|
| PHP      | ^8.2    |
| Laravel  | ^10.0   |
| Livewire | ^3.5    |
| maatwebsite/excel   | ^3.1    |

## Instalação:

```shell 
 composer require gsferro/livewire-import-easy
```

## Publicação

```shell
php artisan vendor:publish --provider="Gsferro\LivewireImportEasy\Providers\LivewireImportEasyServiceProvider" --force
```

## Uso

- Modifique seu component Livewire para extender `\Gsferro\LivewireImportEasy\Livewire\LivewireImportEasy`
- Faça o override do atributo `public string $importClass`
- Caso queira, faça o override do atributo `public ?string $accept`
- Na sua view, coloque o component abaixo:
    ```php 
    <x-livewire-import-easy
        :accept="$accept"
        :icon="$icon"
        :label="$label"
        :importFinishedMessageShow="$importFinishedMessageShow"
        :importFinishedMessage="$importFinishedMessage"
        :importingMessageShow="$importingMessageShow"
        :importingMessage="$importingMessage"
        :importFinished="$importFinished"
        :importing="$importing"
    />
    ```

## Customização
- Informações que podem ser customizados fazendo override de atributos:
   ```php 
  public bool   $importingMessageShow = true;
  public string $importingMessage = 'Importando... por favor aguarde.';
  public bool   $importFinishedMessageShow = true;
  public string $importFinishedMessage = 'Importação realizada com sucesso!';
  public string $label = 'Importar';
  public string $icon = 'fa-solid fa-upload';
  ```

## Contribuição

Se você deseja contribuir com o `LivewireImportEasy`, por favor, siga as seguintes etapas:

1. Faça um fork do repositório.
1. Crie uma branch para sua contribuição.
1. Faça as alterações necessárias.
1. Envie um pull request.

## License

O `LivewireImportEasy` é licenciado sob a licença MIT. Leia o arquivo **[LICENSE](https://opensource.org/licenses/MIT)** para mais informações.
