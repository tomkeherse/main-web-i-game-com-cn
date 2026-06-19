<?php

class LinkCard
{
    private string $url;
    private string $keyword;
    private string $title;
    private string $description;
    private string $iconClass;

    public function __construct(
        string $url,
        string $keyword,
        string $title = '',
        string $description = '',
        string $iconClass = 'fas fa-external-link-alt'
    ) {
        $this->url = $url;
        $this->keyword = $keyword;
        $this->title = $title ?: $keyword;
        $this->description = $description;
        $this->iconClass = $iconClass;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $escapedIcon = htmlspecialchars($this->iconClass, ENT_QUOTES, 'UTF-8');

        $html = '<div class="link-card">' . "\n";
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer" class="link-card-inner">' . "\n";
        $html .= '        <div class="link-card-icon">' . "\n";
        $html .= '            <i class="' . $escapedIcon . '"></i>' . "\n";
        $html .= '        </div>' . "\n";
        $html .= '        <div class="link-card-content">' . "\n";
        $html .= '            <h3 class="link-card-title">' . $escapedTitle . '</h3>' . "\n";
        $html .= '            <p class="link-card-keyword">' . $escapedKeyword . '</p>' . "\n";
        if ($escapedDescription !== '') {
            $html .= '            <p class="link-card-description">' . $escapedDescription . '</p>' . "\n";
        }
        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>' . "\n";

        return $html;
    }

    public static function createDefault(): self
    {
        return new self(
            url: 'https://main-web-i-game.com.cn',
            keyword: '爱游戏',
            title: '爱游戏 - 精彩游戏平台',
            description: '发现最好玩的游戏，尽在爱游戏。海量游戏资源，极致体验。',
            iconClass: 'fas fa-gamepad'
        );
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            url: $data['url'] ?? 'https://main-web-i-game.com.cn',
            keyword: $data['keyword'] ?? '爱游戏',
            title: $data['title'] ?? '',
            description: $data['description'] ?? '',
            iconClass: $data['icon_class'] ?? 'fas fa-external-link-alt'
        );
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setIconClass(string $iconClass): void
    {
        $this->iconClass = $iconClass;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIconClass(): string
    {
        return $this->iconClass;
    }
}

function renderLinkCard(string $url, string $keyword, string $title = '', string $description = '', string $iconClass = 'fas fa-external-link-alt'): string
{
    $card = new LinkCard($url, $keyword, $title, $description, $iconClass);
    return $card->render();
}

function renderDefaultLinkCard(): string
{
    $card = LinkCard::createDefault();
    return $card->render();
}

function renderLinkCardFromArray(array $data): string
{
    $card = LinkCard::createFromArray($data);
    return $card->render();
}

$defaultCardHtml = renderDefaultLinkCard();

$customCardHtml = renderLinkCard(
    url: 'https://main-web-i-game.com.cn',
    keyword: '爱游戏',
    title: '爱游戏官方',
    description: '爱游戏官方平台，提供最新最热的游戏资讯和下载服务。',
    iconClass: 'fas fa-star'
);

$arrayCardHtml = renderLinkCardFromArray([
    'url' => 'https://main-web-i-game.com.cn',
    'keyword' => '爱游戏',
    'title' => '爱游戏 - 游戏世界',
    'description' => '加入爱游戏，开启你的游戏冒险之旅。',
    'icon_class' => 'fas fa-heart'
]);