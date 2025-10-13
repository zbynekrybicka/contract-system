import type { Config } from 'jest';
const config: Config = {
  testEnvironment: 'jsdom',
  setupFilesAfterEnv: ['<rootDir>/tests/setup.ts'],
  transform: { '^.+\\.(t|j)sx?$': 'babel-jest' },
  moduleNameMapper: { '\\.(css|scss)$': 'identity-obj-proxy' },
  testPathIgnorePatterns: ['/node_modules/', '/dist/'],
  extensionsToTreatAsEsm: ['.ts', '.tsx'],
};
export default config;
