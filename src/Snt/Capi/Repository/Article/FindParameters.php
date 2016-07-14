<?php

namespace Snt\Capi\Repository\Article;

final class FindParameters
{
    const DEFAULT_SEPARATOR = ',';

    /**
     * @var string
     */
    private $publicationId;

    /**
     * @var int[]|null
     */
    private $articleIds;

    /**
     * @var int|null
     */
    private $articleId;

    private function __construct()
    {
    }

    /**
     * @param string $publicationId
     *
     * @return FindParameters
     */
    public static function createForPublicationId($publicationId)
    {
        $self = new self();

        $self->publicationId = $publicationId;

        return $self;
    }

    /**
     * @param string $publicationId
     * @param string $articleId
     *
     * @return FindParameters
     */
    public static function createForPublicationIdAndArticleId($publicationId, $articleId)
    {
        $self = new self();

        $self->articleId = $articleId;
        $self->publicationId = $publicationId;

        return $self;
    }

    /**
     * @param string $publicationId
     * @param int[] $articleIds
     *
     * @return FindParameters
     */
    public static function createForPublicationIdAndArticleIds($publicationId, array $articleIds)
    {
        $self = new self();

        $self->publicationId = $publicationId;
        $self->articleIds = $articleIds;

        return $self;
    }

    /**
     * @return string
     */
    public function getPublicationId()
    {
        return $this->publicationId;
    }

    /**
     * @return int[]
     */
    public function getArticleIds()
    {
        return $this->articleIds;
    }

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @return bool
     */
    public function hasArticleId()
    {
        return !is_null($this->articleId);
    }

    /**
     * @param string|null $separator
     *
     * @return string
     */
    public function buildArticleIdsString($separator = self::DEFAULT_SEPARATOR)
    {
        if (!is_null($this->articleId)) {
            return $this->articleId;
        } elseif (!is_null($this->articleIds)) {
            return implode($separator, $this->articleIds);
        }

        return '';
    }
}
