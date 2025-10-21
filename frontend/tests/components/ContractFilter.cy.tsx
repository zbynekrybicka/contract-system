import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContractFilter from '../../src/components/ContractFilter'


describe('ContractFilter.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContractFilter /></Provider>)
  })
})