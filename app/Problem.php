<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

/**
 * Class Problem
 *
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $archive
 * @property string $description
 * @property boolean $difficulty
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereArchive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Problem whereDifficulty($value)
 * @mixin \Eloquent
 */
class Problem extends Model
{
    use SoftDeletes;
    use Sortable;

    public $max_points;
    public $review_required;
    public $time_penalty;

    const RESULTS_PER_PAGE = 10;
    protected static $sortable_columns = [
        'id', 'name', 'created_at', 'updated_at', 'deleted_at', 'difficulty',
    ];

    public $fillable = [
        'name', 'description', 'difficulty', 'archive'
    ];

    public static function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:3000',
            'difficulty' => 'required|integer|between:0,5',
            'archive' => 'required,mimetypes:application/x-gzip',
            //'volumes' => 'array'
        ];
    }

    public function getFilePath()
    {
        $dir = storage_path('app/problems/' . $this->id . '/');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        return $dir;
    }

    public function getImagePath() {
        $dir = public_path('problemdata/' . $this->id . '/');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        return $dir;
    }
    /*
        public static function getAlternateFilePath()
        {
            return base_path('var/test_db/');
        }*/

    /*    public function volumes()
        {
            return $this->belongsToMany('App\Volume');
        }*/

    /*    public function contests()
        {
            return $this->belongsToMany(Contest::class, 'contest_problem', 'problem_id', 'contest_id')->withTimestamps();
        }*/

    public function setImage($name)
    {
        if (Input::file($name)->isValid()) {
            if (File::exists($this->getImagePath() . 'image.png')) {
                File::delete($this->getImagePath() . 'image.png');
            }

            Input::file($name)->move($this->getImagePath(), 'image.png');
        }
    }

    public function getImageAttribute() {
        if (!File::exists($this->getImagePath() . 'image.png')) {
            return asset('frontend-bundle/media/no-problem-image.png');
        }
        return asset('problemdata/' . $this->id . '/image.png');
    }

    public function setArchive($name)
    {
        if (Input::file($name)->isValid()) {
            if (isset($this->attributes['archive'])) {
                File::delete($this->getFilePath() . $this->attributes['archive']);
            }
            $this->attributes['archive'] = Input::file($name)->getClientOriginalName();
            Input::file($name)->move($this->getFilePath(), $this->attributes['archive']);
            File::copy($this->getFilePath() . $this->attributes['archive'], static::getAlternateFilePath() . $this->id . '.tar.gz');
        }
    }

    public function getArchiveAttribute($value)
    {
        try {
            return File::get($this->getFilePath() . $value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getArchivePath() {
        return $this->getFilePath() . $this->attributes['archive'];
    }

    public static function search($term, $page)
    {
        $problems = static::select(['id', 'name'])
            ->where('name', 'LIKE', '%' . $term . '%');

        $count = $problems->count();
        $problems = $problems->skip(($page - 1) * static::RESULTS_PER_PAGE)
            ->take(static::RESULTS_PER_PAGE)
            ->get();
        return ['results' => $problems, 'total_count' => $count];
    }
}
