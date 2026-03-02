<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Mail\ContactReply;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Contact Submissions';

    protected static ?string $navigationGroup = 'Contact';

    public static function getNavigationBadge(): ?string
    {
        $count = ContactSubmission::whereNull('read_at')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->disabled(),
                        Forms\Components\TextInput::make('subject')
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->disabled()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Read At'),
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->label('Replied At')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Reply')
                    ->schema([
                        Forms\Components\Textarea::make('reply_message')
                            ->label('Reply Sent')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => $record?->replied_at !== null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(35)
                    ->placeholder('No subject'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),

                Tables\Columns\IconColumn::make('read_at')
                    ->label('Read')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),

                Tables\Columns\IconColumn::make('replied_at')
                    ->label('Replied')
                    ->boolean()
                    ->trueIcon('heroicon-o-chat-bubble-left-right')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\Filter::make('unread')
                    ->label('Unread')
                    ->query(fn ($query) => $query->whereNull('read_at')),
                Tables\Filters\Filter::make('unreplied')
                    ->label('Needs Reply')
                    ->query(fn ($query) => $query->whereNull('replied_at')),
            ])
            ->actions([
                Tables\Actions\Action::make('reply')
                    ->label(fn (ContactSubmission $record) => $record->replied_at ? 'Reply Again' : 'Reply')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->modalHeading(fn (ContactSubmission $record) => 'Reply to ' . $record->name)
                    ->modalDescription(fn (ContactSubmission $record) =>
                        'Original message: "' . \Illuminate\Support\Str::limit($record->message, 100) . '"')
                    ->form([
                        Forms\Components\Textarea::make('reply')
                            ->label('Your Reply')
                            ->placeholder('Type your response...')
                            ->required()
                            ->rows(6),
                    ])
                    ->action(function (ContactSubmission $record, array $data) {
                        try {
                            Mail::to($record->email)
                                ->send(new ContactReply($record, $data['reply']));

                            $record->update([
                                'reply_message' => $data['reply'],
                                'replied_at' => now(),
                                'read_at' => $record->read_at ?? now(),
                            ]);

                            Notification::make()
                                ->title('Reply sent successfully')
                                ->body('Email sent to ' . $record->email)
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Log::error('Reply email failed: ' . $e->getMessage());

                            Notification::make()
                                ->title('Failed to send reply')
                                ->body('Error: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),

                Tables\Actions\Action::make('markRead')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn (ContactSubmission $record) => $record->update(['read_at' => now()]))
                    ->visible(fn (ContactSubmission $record) => is_null($record->read_at))
                    ->requiresConfirmation(false),

                Tables\Actions\EditAction::make()
                    ->label('View'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'edit' => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
