<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentSubmissions extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Contact Submissions';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactSubmission::query()->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('subject')
                    ->limit(40)
                    ->placeholder('No subject'),

                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('read_at')
                    ->label('Read')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (ContactSubmission $record): string =>
                        route('filament.admin.resources.contact-submissions.edit', $record))
                    ->icon('heroicon-m-eye'),

                Tables\Actions\Action::make('markRead')
                    ->label('Mark Read')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->action(fn (ContactSubmission $record) => $record->update(['read_at' => now()]))
                    ->visible(fn (ContactSubmission $record) => is_null($record->read_at))
                    ->requiresConfirmation(false),
            ])
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
}
