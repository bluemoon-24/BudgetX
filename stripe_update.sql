-- BudgetX Stripe Integration Migration

USE budgetx;

-- Update Users table with subscription fields
ALTER TABLE users 
ADD COLUMN subscription_status ENUM('ACTIVE', 'INACTIVE', 'CANCELLED') DEFAULT 'INACTIVE',
ADD COLUMN subscription_start_date DATETIME NULL,
ADD COLUMN subscription_end_date DATETIME NULL;

-- Ensure payments table is up to date
-- Note: Renaming column if it exists as stripe_payment_id
ALTER TABLE payments 
CHANGE COLUMN stripe_payment_id stripe_charge_id VARCHAR(255) NOT NULL;

-- Create Webhooks Log table
CREATE TABLE IF NOT EXISTS webhooks_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_type VARCHAR(100) NOT NULL,
    payload TEXT NOT NULL,
    processed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
