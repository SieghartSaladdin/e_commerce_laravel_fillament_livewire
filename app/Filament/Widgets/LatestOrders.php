<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\OrderResource;
use Filament\Tables\Columns\SelectColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([

                TextColumn::make('id')
                ->label('Order Id')
                ->sortable()
                ->searchable(),

                TextColumn::make('user.name')
                ->label('Customer')
                ->sortable()
                ->searchable(),

                TextColumn::make('grand_total')
                ->numeric()
                ->sortable()
                ->money('IDR')
                ->searchable(),

                TextColumn::make('payment_method')
                ->searchable()
                ->sortable(),

                TextColumn::make('payment_status')
                ->searchable()
                ->sortable(),

                // TextColumn::make('shipping_method')
                // ->searchable()
                // ->sortable(),

                SelectColumn::make('status')
                ->options([
                    'new' => 'New',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ])
                ->searchable()
                ->sortable(),

                TextColumn::make('created_at')
                ->label('Order Date')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->actions([
                Action::make('View Order')
                ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                ->icon('heroicon-m-eye')
            ]);
    }
}
