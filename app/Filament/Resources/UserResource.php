<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\AddressesRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\PhonesRelationManager;
use App\Models\User;
use Archilex\FilamentFilterSets\Filters\FilterSetFilter;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

use function PHPSTORM_META\map;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TagsInput::make('test'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Select::make('tedsfdst')
                    ->options([
                        '1' => 'option 1',
                        '2' => 'option 2'
                    ])
                    ->createOptionForm([
                        Select::make('asfaadf')
                            ->options([
                                '1' => 'option 1',
                                '2' => 'option 2'
                            ])
                            ->createOptionForm([
                                TagsInput::make('summary')
                                    ->label(__('filament-filter-sets::filter.forms.filters.label'))
                                    ->helperText(config('filament-filter-sets.forms.display_helper_text.filters', true)
                                        ? __('filament-filter-sets::filter.forms.filters.helper_text')
                                        : ''),
                            ]),
                    ]),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->reorderable('id')
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
            ])
            ->groups([
                Group::make('name')
                    ->collapsible(),
                Group::make('email'),
            ])
            ->bulkActions([
                ActionGroup::make([
                    BulkAction::make('test')
                        ->form([
                            Forms\Components\Select::make('authorId')
                                ->label('Author')
                                ->options(User::query()->pluck('name', 'id'))
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                    Forms\Components\TextInput::make('email')
                                        ->required()
                                        ->email(),
                                ])
                                ->required(),
                        ]),
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationGroup::make('Test', [
                AddressesRelationManager::class,
                PhonesRelationManager::class,
            ]),
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
