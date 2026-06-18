-- ============================================================
--  GoTrip Bhavnagar — DATABASE MIGRATION
--  Run this if you already imported setup_full.sql previously.
--  If you are doing a FRESH install, use setup_full_v2.sql instead.
-- ============================================================

-- Add image_path column to reviews table (safe — won't fail if it already exists)
ALTER TABLE `reviews`
  ADD COLUMN IF NOT EXISTS `image_path` VARCHAR(300) NULL DEFAULT NULL
  AFTER `message`;

-- ============================================================
--  That's all. Existing reviews are unaffected (image_path = NULL).
-- ============================================================
