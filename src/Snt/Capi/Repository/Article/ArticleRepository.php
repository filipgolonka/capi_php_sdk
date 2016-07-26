<?php

namespace Snt\Capi\Repository\Article;

use Snt\Capi\Http\Exception\ApiHttpClientException;
use Snt\Capi\Http\Exception\ApiHttpClientNotFoundException;
use Snt\Capi\Repository\AbstractRepository;
use Snt\Capi\Repository\FindParametersInterface;

class ArticleRepository extends AbstractRepository implements ArticleRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function find(FindParametersInterface $findParameters)
    {
        try {
            $articleRawData = json_decode($this->makeHttpGetRequest($findParameters), true);
        } catch (ApiHttpClientNotFoundException $exception) {
            return null;
        } catch (ApiHttpClientException $exception) {
            $this->throwCouldNotFetchException($exception);
        }

        return $articleRawData;
    }

    /**
     * {@inheritdoc}
     */
    public function findByIds(FindParametersInterface $findParameters)
    {
        try {
            $articlesRawData = json_decode($this->makeHttpGetRequest($findParameters), true);
        } catch (ApiHttpClientNotFoundException $exception) {
            return [];
        } catch (ApiHttpClientException $exception) {
            $this->throwCouldNotFetchException($exception);
        }

        return isset($articlesRawData['articles']) ? $articlesRawData['articles'] : [];
    }

    /**
     * {@inheritdoc}
     */
    public function findByChangelog(FindParametersInterface $findParameters)
    {
        try {
            $articlesChangelogRawData = json_decode($this->makeHttpGetRequest($findParameters), true);
        } catch (ApiHttpClientException $exception) {
            $this->throwCouldNotFetchException($exception);
        }

        return $articlesChangelogRawData;
    }

    /**
     * {@inheritdoc}
     */
    public function findBySections(FindParametersInterface $findParameters)
    {
        try {
            $articlesRawData = json_decode($this->makeHttpGetRequest($findParameters), true);
        } catch (ApiHttpClientException $exception) {
            $this->throwCouldNotFetchException($exception);
        }

        return isset($articlesRawData['teasers']) ? $articlesRawData['teasers'] : [];
    }
}
