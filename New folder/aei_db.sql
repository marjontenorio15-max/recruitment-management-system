-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 11:49 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aei_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` bigint(20) NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `applicant_id`, `first_name`, `last_name`, `middle_name`, `address`, `sex`, `civil_status`, `birth_date`, `birth_place`, `age`, `email_address`, `contact_no`, `degree`, `file_attachment`, `remarks`, `created_at`, `updated_at`) VALUES
(32, '12', 'John Raister', 'Garcia', 'Vargas', 'Baclaran Cabuyao Laguna', 'Male', 'Single', '2022-11-18', 'Cabuyao', 23, 'raister@gmail.com', 912346798, 'college', 'SOwKM3ByCzbOyK4eWASeAcxrhENvQDUHcdXUec4F.docx', 'pending..', '2022-11-22 02:41:26', '2022-11-22 02:41:26'),
(40, '11', 'marjon', 'tenorio', 'de guzman', 'asdasd', 'Male', 'Single', '2022-11-08', 'sasdasd', 89, 'kcompany@gmail.com', 912346798, 'GED', '5bm46C16fyCLUUXLldfQMFnatbKjtWDDr44RsBZO.docx', 'pending..', '2022-11-23 23:54:01', '2022-11-23 23:54:01'),
(41, '14', 'John ', 'Doe', 'Dela Cruz', 'Cabuayo Laguna', 'Male', 'Single', '1997-03-24', 'Cabuyao Laguna', 25, 'johndoe@gmail.com', 912346798, 'Bachelor of Science', '7heq9a6Z8JdDTWmdCrcCr5v7vqEKR3jR8WCs3dNZ.docx', 'pending..', '2022-11-24 02:35:50', '2022-11-24 02:35:50'),
(43, '15', 'kenneth', 'dela cruz', 'main', 'asdhkksj', 'Male', 'Single', '2020-02-12', 'asdasdasd', 25, 'kenneth@gmail.com', 912346798, 'Bachelor of Science', '', 'pending..', '2022-11-25 04:49:11', '2022-11-25 04:52:22'),
(44, '16', 'mikko', 'tenorio', 'de guzman', 'asdasd', 'Male', 'Married', '1999-12-12', 'asdasd', 22, 'mikko@gmail.com', 912346798, 'Elementary Diploma', 'VLig7DY4npYBBpS2pY9pJ7ldKaeaXRvE1EZGcJxh.pdf', 'pending..', '2022-11-27 02:15:48', '2022-11-27 02:15:48'),
(46, '18', 'juan', 'dela', 'cruz', 'asdasdasd', 'Male', 'Single', '1999-03-02', 'asdasdas', 23, 'delacruz@gmail.com', 912346798, 'Associate of Applied Science', 'mEmXaMAYFQFB52A8hP6ARxAa0uRwbKBbwtKEGJRv.pdf', 'pending..', '2022-11-28 02:07:33', '2022-11-28 02:47:07'),
(47, '19', 'marvic', 'recare', 'galang', 'asdasdas', 'Male', 'Single', '1994-03-24', 'asdasd', 28, 'marvicgalangrecare@gmail.com', 912346798, 'High School Diploma', '88ur1zUGEnsZRXqdnSo7u0NClWfKyflu5k812VuJ.pdf', 'pending..', '2022-11-28 06:06:26', '2022-11-28 06:06:26'),
(50, '2', 'Christian', 'Caringal', 'olea', 'asdasdasd', 'Male', 'Single', '1999-07-01', 'cabuyao laguna', 23, 'Caringal@gmail.com', 912346798, 'Elementary Diploma', 'Bmy3DFACO4wHUgBkLLnXxWl1dz3ihLOI1FUt127f.pdf', 'pending..', '2022-11-29 00:06:13', '2022-11-29 00:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`id`, `job_id`, `applicant_id`, `remarks`, `created_at`, `updated_at`) VALUES
(26, 1, 2, 'pending..ss', '2022-11-20 23:22:54', '2022-11-21 00:09:20'),
(29, 2, 2, 'pending..', '2022-11-21 22:58:49', '2022-11-21 22:58:49'),
(31, 2, 12, 'pending..', '2022-11-22 02:41:52', '2022-11-22 02:41:52'),
(32, 1, 11, 'pending..', '2022-11-23 23:07:22', '2022-11-23 23:07:22'),
(35, 3, 14, 'pending..', '2022-11-24 03:24:20', '2022-11-24 03:24:20'),
(36, 1, 15, 'pending..', '2022-11-25 04:49:21', '2022-11-25 04:49:21'),
(37, 3, 15, 'for interview', '2022-11-25 04:54:22', '2022-11-25 04:55:49'),
(38, 9, 16, 'pending..', '2022-11-27 02:20:29', '2022-11-27 02:20:29'),
(39, 28, 19, 'pending..', '2022-11-28 06:12:50', '2022-11-28 06:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_id`, `company_name`, `address`, `contact_no`, `created_at`, `updated_at`) VALUES
(1, 3, 'Nestle', 'Niugan Cabuyao City of Laguna', 912346798, '2022-11-03 16:03:45', '2022-11-03 16:03:45'),
(2, 4, 'Goldilocks', 'Mamatid Cabuyao City of Laguna', 912346799, '2022-11-03 16:07:35', '2022-11-03 16:07:35'),
(3, 6, 'Wyeth', 'Sala', 912346798, '2022-11-03 17:18:14', '2022-11-03 17:18:14'),
(4, 17, 'Del Monte', 'Pulo Cabuyao Laguna', 912346798, '2022-11-27 23:53:55', '2022-11-27 23:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `educational_background`
--

CREATE TABLE `educational_background` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `school_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_location` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_of_study` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month_graduate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_graduate` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educational_background`
--

INSERT INTO `educational_background` (`id`, `applicant_id`, `school_name`, `school_location`, `degree`, `field_of_study`, `month_graduate`, `year_graduate`, `created_at`, `updated_at`) VALUES
(3, 2, 'Pamantasan ng Cabuyao', 'Calamba', 'Elementary Diploma', 'N/A', 'june', '2012', '2022-11-23 22:03:51', '2022-11-23 22:03:51'),
(4, 2, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'Bachelor of Science', 'Information Technology', 'january', '2016', '2022-11-24 01:17:28', '2022-11-24 01:17:28'),
(5, 14, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'Bachelor of Science', 'Information Technology', 'January', '2022', '2022-11-24 02:41:21', '2022-11-24 02:41:21'),
(6, 15, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'Bachelor of Science', 'Information Technology', 'january', '2016', '2022-11-25 04:51:05', '2022-11-25 04:51:05'),
(7, 15, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'Elementary Diploma', 'n/a', 'january', '2016', '2022-11-25 04:51:25', '2022-11-25 04:51:25'),
(8, 15, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'Elementary Diploma', 'n/a', 'january', '2016', '2022-11-25 04:51:25', '2022-11-25 04:51:25'),
(9, 2, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'High School Diploma', 'n/a', 'january', '2016', '2022-11-28 04:34:58', '2022-11-28 04:34:58'),
(10, 19, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'High School Diploma', 'n/a', 'january', '2016', '2022-11-28 06:07:13', '2022-11-28 06:07:13'),
(11, 19, 'Pamantasan ng Cabuyao', 'Cabuyao City', 'Associate of Applied Science', 'Information Technology', 'january', '2016', '2022-11-28 06:07:30', '2022-11-28 06:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employer_remarks`
--

CREATE TABLE `employer_remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employer_remarks`
--

INSERT INTO `employer_remarks` (`id`, `applicant_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 30, 'hired', '2022-11-19 02:33:54', '2022-11-19 02:33:54'),
(3, 30, 'pending...asdsd', '2022-11-19 03:22:55', '2022-11-19 03:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_employed` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `applicant_id`, `job_title`, `company_name`, `period_employed`, `achievements`, `created_at`, `updated_at`) VALUES
(3, 2, 'manufacturing', 'nestle', '2 years', 'kashdjashdkjashd', '2022-11-28 03:56:22', '2022-11-28 03:56:22'),
(4, 2, 'hey', 'nkcompany', '1 year', 'hjgjhgj', '2022-11-28 03:58:17', '2022-11-28 04:25:56'),
(5, 19, 'operator', 'jamas', '1 year', 'best in designer', '2022-11-28 06:11:51', '2022-11-28 06:11:51'),
(6, 19, 'manufacturing', 'nestle', '2 years', 'high in high', '2022-11-28 06:12:29', '2022-11-28 06:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `applicant_id`, `file_path`, `created_at`, `updated_at`) VALUES
(69, 'marjon', 11, '1668986544.d2672e6bcdb5eb3c3e55e60a05b03b40.png_wh860.png', '2022-11-20 15:22:24', '2022-11-20 15:22:24'),
(71, 'marjon', 2, '1669013948.d2672e6bcdb5eb3c3e55e60a05b03b40.png_wh860.png', '2022-11-20 22:59:08', '2022-11-20 22:59:08'),
(72, 'John Dela Cruz Doe', 14, '1669286357.male-user-filled-icon-man-icon-115533970576b3erfsss1.png', '2022-11-24 02:39:17', '2022-11-24 02:39:17'),
(73, 'Goldilocks', 4, '1669287432.male-user-filled-icon-man-icon-115533970576b3erfsss1.png', '2022-11-24 02:57:12', '2022-11-24 02:57:12'),
(74, 'kenneth', 15, '1669380595.IMG_20221108_174930_269.jpg', '2022-11-25 04:49:55', '2022-11-25 04:49:55'),
(75, 'Del Monte', 17, '1669622166.delmonte.png', '2022-11-27 23:56:06', '2022-11-27 23:56:06'),
(76, 'raven', 19, '1669644302.3798.png_300.png', '2022-11-28 06:05:02', '2022-11-28 06:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_26_055030_create_vacancy_table', 1),
(6, '2022_10_26_055134_create_applicant_table', 1),
(7, '2022_10_26_060413_create_company_table', 1),
(8, '2022_10_30_012759_create_employee_table', 1),
(9, '2022_11_04_063356_create_apply_table', 1),
(10, '2022_11_07_055553_create_image_table', 1),
(11, '2022_11_18_132432_create_employer_remarks_table', 1),
(12, '2022_11_23_202108_create_educational_background_table', 2),
(13, '2022_11_27_102408_create_experience_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_list`
--

CREATE TABLE `tbl_job_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_employee` int(11) NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_job_list`
--

INSERT INTO `tbl_job_list` (`id`, `title`, `company_id`, `created_by`, `no_of_employee`, `salary`, `sex`, `degree`, `work_exp`, `job_desc`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Manufacturing', 3, '3', 5, '6-8k', 'Male', 'Bachelor of Science', '2 years', 'we are looking for a accounting graduate', 'cabuyao', '2022-11-03 16:04:35', '2022-11-27 06:03:59'),
(2, 'Production Support', 3, '3', 10, '0', 'Female', 'Bachelor of Science', '', '', 'Banay-banay', '2022-11-03 16:05:36', '2022-11-03 16:05:36'),
(3, 'Coordinator', 4, '4', 10, '0', 'Male', 'Bachelor of Science', '', '', 'Banay-banay', '2022-11-03 16:08:34', '2022-11-03 16:08:34'),
(4, 'Supervisor', 4, '4', 10, '0', 'Male', '', '', '', 'mamatid', '2022-11-03 16:08:52', '2022-11-03 16:08:52'),
(5, 'hr manager', 4, '4', 10, '0', 'Male', '', '', '', 'Sala', '2022-11-06 22:42:42', '2022-11-06 22:42:42'),
(7, 'General Manager', 4, '4', 3, '19 - 20k', 'Male', 'Bachelor of Science', '2 years', 'we are looking for a accounting graduate', 'laguna area', '2022-11-17 04:44:55', '2022-11-17 04:44:55'),
(8, 'web developer', 4, '4', 10, '19 - 20k', 'Male', '', '2 years', 'we are looking for a accounting graduate', 'laguna area', '2022-11-25 04:56:58', '2022-11-25 04:56:58'),
(9, 'tourism', 1, '1', 20, '19 - 20k', 'Female', '', '2 years', 'we are looking for a accounting graduate', 'laguna area', '2022-11-26 23:02:18', '2022-11-26 23:02:18'),
(10, 'Manager', 1, '1', 10, '6-8k', 'Male', 'required', '2 years', 'we are looking for a accounting graduate', 'Cabuyao Laguna', '2022-11-27 22:23:01', '2022-11-27 22:23:01'),
(11, 'Call Center', 1, '1', 20, '6-8k', 'Female', 'required', '1 year', 'we are looking for high school grad or elem grad.', 'Pulo Cabuyao Laguna', '2022-11-27 22:31:20', '2022-11-27 22:31:20'),
(12, 'Warehouse Staff', 1, '1', 100, '6-8k', 'Male', 'required', '2 years', 'we are hiring for warehouse staff', 'Santa Rosa', '2022-11-27 22:35:40', '2022-11-27 22:35:40'),
(13, 'Engineer', 4, '4', 5, '6-8k', 'Male', 'required', '2 years', 'we are looking for Engineer', 'cabuyao', '2022-11-27 22:40:36', '2022-11-27 22:40:36'),
(14, 'Canten Staff', 4, '4', 5, '6-8k', 'Female', 'required', '1 year', 'we are looking for Canten Staff', 'Pulo Cabuyao Laguna', '2022-11-27 22:42:17', '2022-11-27 22:42:17'),
(15, 'Coordinator', 3, '3', 5, '6-8k', 'Female', 'required', '1 year', 'we are looking for Coordinator', 'Banay Banay', '2022-11-27 22:46:15', '2022-11-27 22:46:15'),
(16, 'Supervisor', 3, '3', 5, '6-8k', 'Female', 'required', '2 years', 'we are looking for College graduate', 'Niugan', '2022-11-27 22:47:06', '2022-11-27 22:47:06'),
(17, 'Engineering staff', 3, '3', 5, '19 - 20k', 'Male', 'required', '2 years', 'we are looking for Engineering Graduate', 'Pulo Cabuyao Laguna', '2022-11-27 22:48:26', '2022-11-27 22:48:26'),
(18, 'Producation Operator', 6, '6', 100, '6-8k', 'Male', 'Bachelor of Science', '1 year', 'We looking for Producation Operator', 'Banay Banay', '2022-11-27 22:51:59', '2022-11-27 22:51:59'),
(19, 'Supervisor', 6, '6', 10, '6-8k', 'Female', 'required', '2 years', 'we are looking for Supervisor', 'laguna area', '2022-11-27 22:54:02', '2022-11-27 22:54:02'),
(20, 'Store Crew', 3, '3', 10, '3000-6000', 'Female', 'required', '1 year', 'We are Hirinig Store Crew', 'Sala Cabuyao Laguna', '2022-11-27 23:04:44', '2022-11-27 23:04:44'),
(21, 'Security Guard', 3, '3', 3, '6-8k', 'Male', 'required', '1 year', 'we are hiring for Security Guard', 'Pulo Cabuyao Laguna', '2022-11-27 23:06:31', '2022-11-27 23:06:31'),
(22, 'Finance/Accounts Executive', 3, '3', 5, '19 - 20k', 'Female', 'required', '2 years', 'We are Looking for Finance/Accounts Executive', 'Banay Banay', '2022-11-27 23:09:24', '2022-11-27 23:09:24'),
(23, 'Team Leader-IT', 3, '3', 10, '15 - 20k', 'Female', 'required', '2 years', 'we are looking for Team Leader-IT', 'Banay Banay', '2022-11-27 23:10:39', '2022-11-27 23:10:39'),
(24, 'Site Supervisor', 3, '3', 10, '10 - 15k', 'Female', 'required', '2 years', 'we are looking for Site Supervisor', 'Banay Banay', '2022-11-27 23:11:48', '2022-11-27 23:11:48'),
(25, 'Finance Officer', 4, '4', 10, '5 - 10k', 'Female', 'required', '1 year', 'we are looking for Finance Officer', 'Mamatid Cabuyao Laguna', '2022-11-27 23:18:10', '2022-11-27 23:18:10'),
(26, 'Finance for Accounts Payable', 4, '4', 5, '5 - 10k', 'Female', 'required', '1 year', 'we are looking for Finance for Accounts Payable', 'Mamatid Cabuyao Laguna', '2022-11-27 23:19:29', '2022-11-27 23:19:29'),
(27, 'Purchasing Officer', 4, '4', 10, '10 - 15k', 'Female', 'required', '1 year', 'we are looking for Purchasing Officer', 'Mamatid Cabuyao Laguna', '2022-11-27 23:23:47', '2022-11-27 23:23:47'),
(28, 'Coordinator', 17, '17', 10, '5 - 10k', 'Male', 'High School Diploma', '2 years', 'we are looking for Coordinator', 'Pulo Cabuyao Laguna', '2022-11-27 23:59:43', '2022-11-28 00:16:15'),
(29, 'Supervisor', 17, '17', 10, '10 - 15k', 'Female', 'Associate of Science', '2 years', 'we are looking for Supervisor', 'Pulo Cabuyao Laguna', '2022-11-28 00:00:19', '2022-11-28 00:17:32'),
(30, 'Producation Opearator', 17, '17', 100, '10 - 15k', 'Male', 'required', '1 year', 'we are looking for Producation Operator', 'Pulo Cabuyao Laguna', '2022-11-28 00:01:28', '2022-11-28 00:01:28'),
(31, 'Customer Development Management', 17, '17', 10, '10 - 15k', 'Female', 'required', '2 years', 'we are looking for Customer Development Management', 'Pulo Cabuyao Laguna', '2022-11-28 00:03:24', '2022-11-28 00:03:24'),
(32, 'Engineering Technical Staff', 17, '17', 10, '15 - 20k', 'Male', 'Associate of Applied Science', '2 years', 'we are looking for Engineering Technical Staff', 'Pulo Cabuyao Laguna', '2022-11-28 00:08:52', '2022-11-28 00:20:40'),
(33, 'packer', 17, '17', 10, '20 - 25k', 'Male', 'High School Diploma', '3 years', 'we are looking for a accounting graduate', 'Mamatid Cabuyao Laguna', '2022-11-28 00:26:15', '2022-11-28 00:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'admin@gmail.com', 'admin', NULL, '$2y$10$T26KBeDStveK3oXDtaHkGOwYU2WstX1zcZC4aVccODfNxcwzDemYq', NULL, '2022-11-03 16:00:56', '2022-11-03 16:00:56'),
(2, 3, NULL, 'Caringal@gmail.com', 'caringal', NULL, '$2y$10$EPG63VljIdKBZ5RtSK97U.JuTnZFEFv64Hr/hsjQxIkdkkWjG7qxi', 'F95ED7xi8vDPRem1LTp2VyBC9Q45hapjunyelPi2FedYMRnMLSrSo0IDcUSu', '2022-11-03 16:01:29', '2022-11-03 16:01:29'),
(3, 2, NULL, 'nestle@gmail.com', 'Nestle', NULL, '$2y$10$D7RHzIZ1Xllw1Os5/lKu0uK3QeDmRKOjqlJ8W9igqmJBwEjOWGe7S', NULL, '2022-11-03 16:03:45', '2022-11-03 16:03:45'),
(4, 2, NULL, 'Goldilocks@gmail.com', 'Goldilocks', NULL, '$2y$10$uDUCvPlnos1AS7z3/o2OnOtFPtPlSeUP15aBbMNSebAdy7C2nFYoq', 'e3yA9NA2de778SC2djABZf5J1Decy6fx1XC44VMnRzTrWPojpGCKYbE8vNbY', '2022-11-03 16:07:35', '2022-11-03 16:07:35'),
(6, 2, NULL, 'Wyeth@gmail.com', 'Wyeth', NULL, '$2y$10$TkQdkhwycTt3j19A6.zbhu1N1c7Ij7Bo.txfDMOgkNQxtPy/0PkJa', NULL, '2022-11-03 17:18:14', '2022-11-03 17:18:14'),
(11, 3, NULL, 'marjontenorio15@gmail.com', 'marjon', NULL, '$2y$10$ik7ukSLvofgKwB/4vOykKuVYU3u5JGyhFNf6hTFMsYtW721VILnxS', NULL, '2022-11-20 11:28:02', '2022-11-23 23:57:04'),
(12, 3, NULL, 'raister@gmail.com', 'raister', NULL, '$2y$10$rGA65WGqURsDNkXznBc9CexFvDEyyijWcyYmWzrknJ2lRuAwDm8Nu', NULL, '2022-11-22 02:39:00', '2022-11-22 02:39:00'),
(14, 3, 'John Doe', 'johndoe@gmail.com', 'John Doe', NULL, '$2y$10$ixMzLcww9eqZ/k5dcmjHEeNiuZrgVC86sVLG58yjGqxa8iBwB5TQu', NULL, '2022-11-24 02:31:39', '2022-11-24 02:31:39'),
(15, 3, 'kenneth', 'kenneth@gmail.com', 'kenneth', NULL, '$2y$10$Tw56wjTmCQM/vG5nu1OCkumQyv7deg1eBBUHZYNqPmZ9DjOC/a0JO', NULL, '2022-11-25 04:46:43', '2022-11-25 04:46:43'),
(16, 3, 'mikko', 'mikko@gmail.com', 'mikko', NULL, '$2y$10$v6UvRnYzPlqGEyE364anX.EGqJ6mMgaBfDWMPMaftUv41JbxinrDe', NULL, '2022-11-27 00:44:55', '2022-11-27 00:44:55'),
(17, 2, NULL, 'Delmonte@gmail.com', 'Del Monte', NULL, '$2y$10$edNmsp9xUxn7g3Uzpt1i/uIPqqS14UTCWu.gl7SaeVmwjrBty8xxy', NULL, '2022-11-27 23:53:55', '2022-11-27 23:53:55'),
(18, 3, 'juan dela cruz', 'delacruz@gmail.com', 'delacruz', NULL, '$2y$10$2ntUF.SoH8Hoteh0PTSbT.IRCQoAwcJ5M9r966kLJLDtWSjzEJPZe', NULL, '2022-11-28 00:36:34', '2022-11-28 00:36:34'),
(19, 3, 'marvic', 'marvicgalangrecare@gmail.com', 'raven', NULL, '$2y$10$pmYkTWUgnKlWiTrMy8T5NeuZBIZZlp/amw/pQAVn23vaUcKbMzNW.', NULL, '2022-11-28 06:04:20', '2022-11-28 06:04:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_company_id_unique` (`company_id`);

--
-- Indexes for table `educational_background`
--
ALTER TABLE `educational_background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employer_company_id_unique` (`company_id`),
  ADD UNIQUE KEY `employer_email_unique` (`email`);

--
-- Indexes for table `employer_remarks`
--
ALTER TABLE `employer_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_job_list`
--
ALTER TABLE `tbl_job_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `educational_background`
--
ALTER TABLE `educational_background`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employer_remarks`
--
ALTER TABLE `employer_remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job_list`
--
ALTER TABLE `tbl_job_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
